<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BackendController;
use App\User as Model;

class UserController extends BackendController
{
    public function __construct(Model $model, $base = 'user')
    {
        parent::__construct($model, $base);
        view()->share('breadcrumb2Icon', 'users');
        view()->share('fields', array_except($this->model->getFields(), ['id']));
    }
}
