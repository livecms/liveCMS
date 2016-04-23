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
                return $data->is_banned ? '<span class="text-red" title="User is banned">'.$data->name.'</span>' : $data->name;
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
            Form::open(['style' => 'display: inline!important', 'method' => 'delete',
                'action' => [$this->baseClass.'@destroy', $data->{$this->model->getKeyName()}]
            ]).
            (
                ! $data->is_banned ?
                '  <button type="submit" onClick="return confirm(\''.trans('backend.bannedconfirmation').'\');" 
                    class="btn text-red btn-small btn-link">
                        <i class="fa fa-xs fa-ban"></i> 
                        Ban
                </button>
                </form>'
                : '<span class="text-red" title="User is banned">Banned</span>'
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

        $banned = $this->role->where('role', Role::BANNED)->first()->id;
        $this->model->roles()->detach();
        $this->model->roles()->attach($banned);

        return $this->redirection();
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

        $role = $this->role->where('role', Role::AUTHOR)->first()->id;
        $this->model->roles()->attach($role);

        return parent::afterSaving($request);
    }
}
