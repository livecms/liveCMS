<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\liveCMS\Controllers\BackendController;
use App\Models\ProjectCategory as Model;

class ProjectCategoryController extends BackendController
{
    public function __construct(Model $model, $base = 'projectcategory')
    {
        parent::__construct($model, $base);
        $this->breadcrumb2Icon  = 'list';
        $this->fields           = array_except($this->model->getFields(), ['id']);
        
        $this->view->share();
    }
}
