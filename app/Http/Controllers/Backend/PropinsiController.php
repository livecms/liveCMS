<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BackendController;
use App\Models\Propinsi as Model;

class PropinsiController extends BackendController
{
    public function __construct(Model $model, $base = 'propinsi')
    {
        parent::__construct($model, $base);
        $this->breadcrumb2Icon  = 'map';
        $this->fields           = array_except($this->model->getFields(), ['id']);
        
        $this->view->share();
    }
}
