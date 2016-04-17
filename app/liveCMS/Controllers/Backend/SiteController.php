<?php

namespace App\liveCMS\Controllers\Backend;

use App\liveCMS\Controllers\BackendController;
use App\liveCMS\Models\SiteModel as Model;
use App\liveCMS\Models\User;
use App\liveCMS\Models\Setting;
use App\liveCMS\Models\Users\Role;

class SiteController extends BackendController
{
    protected $user;
    protected $role;
    protected $setting;
    protected $emails;

    public function __construct(Model $model, User $user, Role $role, Setting $setting, $base = 'site')
    {
        $this->user = $user;
        $this->setting = $setting;
        $this->role = $role->where('role', Role::ADMIN)->first()->id;

        parent::__construct($model, $base);
        $this->breadcrumb2Icon  = 'globe';
        $this->fields           = array_except($this->model->getFields(), ['id']);

        $this->view->share();
    }

    protected function processRequest($request)
    {
        $request = parent::processRequest($request);

        $emails = [];
        foreach ($request->all() as $key => $value) {
            
            if (starts_with($key, 'emails_')) {
                $emails[] = $value;
            }
        }

        $this->emails = $emails;

        $request->merge(compact('emails'));

        if ($request->has('sitename')) {

            $request->merge(['site' => $request->get('sitename')]);
        }

        return $request;
    }

    protected function makeAdmin($email, $username)
    {
        $site_id = $this->model->id;

        $user = $this->user->where('site_id', $site_id)->where('email', $email)->first();

        if ($user == null) {
            $emails = explode('@', $email);
            $name = array_shift($emails);
            $user = $this->user->createUser(compact('site_id', 'name', 'username', 'email'));
        }
        
        $user->roles()->attach($this->role);
    }

    protected function getInitial($name)
    {
        $name = strtoupper($name);

        $words = count($names = explode(' ', $name));

        $inits = array_map(function ($value) {
            return substr($value, 0, 1);
        }, $names);

        $initials = $inits[0]. ($words > 1 ?  last($inits) : '');

        return $initials;
    }

    protected function afterSaving($request)
    {
        $siteName = $this->setting->firstOrNew(['site_id' => $this->model->id, 'publicable' => true, 'key' => 'site_name']);
        $siteName->value = $this->model->site;
        $siteName->save();

        $siteInitial = $this->setting->firstOrNew(['site_id' => $this->model->id, 'publicable' => true, 'key' => 'site_initial']);
        $siteInitial->value = $this->getInitial($this->model->site);
        $siteInitial->save();

        $this->model->users->each(function ($user, $key) {

            $user->roles()->detach($this->role);
        });

        if ($this->emails) {

            foreach ($this->emails as $email) {
                $username = $email;
                $this->makeAdmin($email, $username);
            }
        } else {
            $username = $email= $request->get('email');
            $this->makeAdmin($email, $username);
        }

        return parent::afterSaving($request);
    }
}
