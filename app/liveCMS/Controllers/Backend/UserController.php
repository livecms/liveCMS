<?php

namespace App\liveCMS\Controllers\Backend;

use App\liveCMS\Controllers\BackendController;
use App\liveCMS\Models\User as Model;

class UserController extends BackendController
{
    public function __construct(Model $model, $base = 'user')
    {
        parent::__construct($model, $base);
        $this->model = $this->model->setAllSites(false);
        $this->breadcrumb2Icon  = 'users';
        $this->fields           = array_except($this->model->getFields(), ['id']);
        
        $this->view->share();
    }

    protected function processDatatables($datatables)
    {
        return $datatables
            ->editColumn('avatar', function ($data) {
                $imgUrl = $data->avatar;
                return $data->avatar ? '<a target="_blank"  href="'.$imgUrl.'"><img src="'.$imgUrl.'" style="width: 100px;"></a>' : '-';
            });
    }
}
