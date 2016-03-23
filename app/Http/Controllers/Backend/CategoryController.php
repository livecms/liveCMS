<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\liveCMS\Controllers\BackendController;
use App\Models\Category as Model;

class CategoryController extends BackendController
{
    public function __construct(Model $model, $base = 'category')
    {
        parent::__construct($model, $base);
        $this->breadcrumb2Icon  = 'list';
        $this->fields           = array_except($this->model->getFields(), ['id']);
        
        $this->view->share();
    }
}
