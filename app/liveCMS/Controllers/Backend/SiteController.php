<?php

namespace App\liveCMS\Controllers\Backend;

use App\liveCMS\Controllers\BackendController;
use App\liveCMS\Models\SiteModel as Model;
use App\liveCMS\Models\User;
use App\liveCMS\Models\Users\Role;

class SiteController extends BackendController
{
    protected $user;

    public function __construct(Model $model, User $user, Role $role, $base = 'site')
    {
        $this->user = $user;
        parent::__construct($model, $base);
        $this->breadcrumb2Icon  = 'globe';
        $this->fields           = array_except($this->model->getFields(), ['id']);

        $this->view->share();
    }

    protected function processRequest($request)
    {
        $request = parent::processRequest($request);

        if ($request->has('sitename')) {

            $request->merge(['site' => $request->get('sitename')]);
        }

        return $request;
    }

    protected function afterSaving($request)
    {
        $site_id = $this->model->id;

        $username = $email = $request->get('email');

        $user = $this->user->where('site_id', $site_id)->where('email', $email)->first();

        if ($user == null) {
            $user = $this->user->createUser(compact('site_id', 'username', 'email'));
            $role = Role::where('role', Role::ADMIN)->first();
            $user->roles()->attach($role->id);
            // $user->site->associate()
        }

        $this->model->admins()->save($user);

        return parent::afterSaving($request);
    }
}
