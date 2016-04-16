<?php

namespace App\liveCMS\Controllers\Backend;

use App\liveCMS\Controllers\BackendController;
use App\liveCMS\Models\SiteModel as Model;

class SiteController extends BackendController
{
    public function __construct(Model $model, $base = 'site')
    {
        parent::__construct($model, $base);
        $this->breadcrumb2Icon  = 'globe';
        $this->fields           = array_except($this->model->getFields(), ['id']);
        
        $this->view->share();
    }
}
