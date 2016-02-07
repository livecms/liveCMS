<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BackendController;
use App\Models\Kecamatan as Model;

class KecamatanController extends BackendController
{
    public function __construct(Model $model, $base = 'kecamatan')
    {
        parent::__construct($model, $base);
        view()->share('breadcrumb2Icon', 'map');
        view()->share('fields', array_except($this->model->getFields(), ['id']));
    }
}
