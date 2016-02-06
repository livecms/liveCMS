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
        view()->share('breadcrumb2Icon', 'list');
        view()->share('fields', array_except($this->model->getFields(), ['id']));
    }
}
