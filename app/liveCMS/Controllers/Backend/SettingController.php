<?php

namespace App\liveCMS\Controllers\Backend;

use App\liveCMS\Controllers\BackendController;
use App\liveCMS\Models\Setting as Model;

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
