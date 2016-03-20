<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\liveCMS\Controllers\BackendController;
use App\Models\Setting as Model;

class SettingController extends BackendController
{
    public function __construct(Model $model, $base = 'setting')
    {
        parent::__construct($model, $base);
        $this->breadcrumb2Icon  = 'cog';
        $this->fields           = array_except($this->model->getFields(), ['id']);
        
        $this->view->share();
    }
}
