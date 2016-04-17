<?php

namespace App\liveCMS\Controllers\Backend;

use App\liveCMS\Controllers\BackendController;
use App\liveCMS\Models\User as Model;

class ProfileController extends BackendController
{
    public function __construct(Model $model, $base = 'profile')
    {
        parent::__construct($model, $base);
        $this->model = $this->model->setAllSites(false);
        $this->breadcrumb2Icon  = 'users';
        $this->fields           = array_except($this->model->getFields(), ['id']);
        
        $this->view->share();
    }
}
