<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BackendController;
use App\Models\Kategori as Model;

class KategoriController extends BackendController
{
    public function __construct(Model $model, $base = 'kategori')
    {
        parent::__construct($model, $base);
        $this->breadcrumb2Icon  = 'list';
        $this->fields           = array_except($this->model->getFields(), ['id']);
        
        $this->view->share(get_object_vars($this));
    }
}
