<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BackendController;
use App\Models\Kota as Model;
use App\Models\Propinsi;

class KotaController extends BackendController
{
    protected $propinsi;
    protected $unsortables = ['propinsi_id'];

    public function __construct(Model $model, Propinsi $propinsi, $base = 'kota')
    {
        parent::__construct($model, $base);
        $this->propinsi = $propinsi;

        $this->breadcrumb2Icon  = 'map';
        $this->fields           = array_merge(array_except($this->model->getFields(), ['id']), ['propinsi_id' => 'Propinsi']);
     
        $this->view->share();
    }

    protected function processDatatables($datatables)
    {
        return $datatables
            ->editColumn('propinsi_id', function ($data) {
                return $data->propinsi->propinsi;
            });
    }

    protected function processRequest($request)
    {
        $propinsi_id = $request->get('propinsi');
        $request->merge(compact('propinsi_id'));
     
        return $request;
    }

    protected function loadFormClasses()
    {
        $this->propinsis = $this->propinsi->lists('propinsi', 'id')->toArray();
        $this->view->share();
    }
}
