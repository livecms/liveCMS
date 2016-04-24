<?php

namespace App\liveCMS\Controllers\Backend;

use Form;
use Illuminate\Http\Request;
use App\liveCMS\Controllers\BackendController;
use App\liveCMS\Models\User as Model;
use App\liveCMS\Models\Users\Role;

class UserController extends BackendController
{
    protected $role;

    public function __construct(Model $model, Role $role, $base = 'user')
    {
        parent::__construct($model, $base);
        $this->model = $this->model->setAllSites(false);
        $this->role = $role;
        $this->breadcrumb2Icon  = 'users';
        $this->fields           = array_except($this->model->getFields(), ['id']);
        
        $this->view->share();
    }

    protected function processDatatables($datatables)
    {
        return $datatables
            ->editColumn('name', function ($data) {
                return ($data->is_banned ? '<span class="text-red" title="User is banned">'.$data->name.'</span>' : $data->name). ($data->is_admin ? ' <i class="fa fa-star text-yellow"></i>' : '');
            })
            ->editColumn('username', function ($data) {
                return $data->is_banned ? '<span class="text-red" title="User is banned">'.$data->username.'</span>' : $data->username;
            })
            ->editColumn('email', function ($data) {
                return $data->is_banned ? '<span class="text-red" title="User is banned">'.$data->email.'</span>' : $data->email;
            })
            ->editColumn('avatar', function ($data) {
                $imgUrl = $data->avatar;
                return $data->avatar ? '<a target="_blank"  href="'.$imgUrl.'"><img src="'.$imgUrl.'" style="width: 100px;"></a>' : '-';
            });
    }

    protected function drawMenuField($data)
    {
        return
            '<a href="'.action($this->baseClass.'@edit', [$data->{$this->model->getKeyName()}]).'" 
                class="btn btn-small btn-link">'.
                    ($data->is_banned ? '<span class="text-red" title="User is banned"> <i class="fa fa-xs fa-pencil"></i> Edit</span>' : ' <i class="fa fa-xs fa-pencil"></i> Edit').
            '</a> '.
            (!$data->is_banned ?
            '<a data-method="delete" data-title="'.trans('backend.wanttobanuser').'"
                data-action="'.action($this->baseClass.'@destroy', [$data->{$this->model->getKeyName()}]).'"
                class="btn btn-small btn-link btn-need-auth">
                <i class="fa fa-xs fa-ban"></i>'.trans('livecms.ban').'
            </a>' :
            '<a data-method="put" data-title="'.trans('backend.wanttounbanuser').'"
                data-action="'.action($this->baseClass.'@update', [$data->{$this->model->getKeyName()}]).'"
                class="btn btn-small text-red btn-link btn-need-auth"
                data-hidden=\''.json_encode(['credentials' => 'true', 'unban' => 'true']).'\'>
                <i class="fa fa-xs fa-ban"></i>'.trans('livecms.unban').'
            </a>'
            );
    }

    public function edit(Request $request, $id)
    {
        $model = $this->model->findOrFail($id);
        ${camel_case($this->base)} = $model;
        $this->action       = 'update';
        $this->params       = array_merge($request->query() ? $request->query() : [], compact('id'));
        
        if ($model->is_banned) {
            $this->withoutFormButtons = true;
        }

        $this->view->share();
        
        $this->loadFormClasses($model);
        return view('admin.user.password', compact(camel_case($this->base)));
    }

    public function destroy(Request $request, $id)
    {
        $this->model = $this->model->findOrFail($id);

        $request = $this->processRequest($request);

        if ($request === true) {
            return $this->redirection();
        }

        $banned = $this->role->where('role', Role::BANNED)->first()->id;
        $this->model->roles()->detach();
        $this->model->roles()->attach($banned);

        return $this->redirection();
    }

    protected function processRequest($request)
    {
        $request = parent::processRequest($request);

        if ($request->isMethod('delete')) {

            $this->validate($request, $this->model->rules());

            $banned = $this->role->where('role', Role::BANNED)->first()->id;
            $this->model->roles()->detach();
            $this->model->roles()->attach($banned);

            return true;
        }

        return $request;
    }

    protected function afterSaving($request)
    {
        if ($makeAdmin = $request->has('unban')) {
            $author = $this->role->where('role', Role::AUTHOR)->first()->id;
            $this->model->roles()->detach();
            $this->model->roles()->attach($author);
            return parent::afterSaving($request);
        }

        if ($makeAdmin = $request->has('admin_yes') || $request->has('admin_no')) {

            if ($makeAdmin) {
            
                $admin = $this->role->where('role', Role::ADMIN)->first()->id;
                $this->model->roles()->detach();
                $this->model->roles()->attach($admin);
            
            } else {

                $author = $this->role->where('role', Role::AUTHOR)->first()->id;
                $this->model->roles()->detach();
                $this->model->roles()->attach($author);
            }

            return parent::afterSaving($request);
        }

        
        if ($request->isMethod('post')) {

            $role = $this->role->where('role', Role::AUTHOR)->first()->id;
            $this->model->roles()->attach($role);

            return parent::afterSaving($request);
        }

        return parent::afterSaving($request);
    }
}
