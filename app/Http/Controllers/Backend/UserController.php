<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BackendController;
use App\Models\User as Model;

class UserController extends BackendController
{
    public function __construct(Model $model, $base = 'user')
    {
        parent::__construct($model, $base);
        $this->breadcrumb2Icon  = 'users';
        $this->fields           = array_except($this->model->getFields(), ['id']);
        
        $this->view->share(get_object_vars($this));
    }
}
