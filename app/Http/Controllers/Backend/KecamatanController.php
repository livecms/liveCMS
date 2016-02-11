<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BackendController;
use App\Models\Kecamatan as Model;
use App\Models\Kota;

class KecamatanController extends BackendController
{
    protected $kota;
    protected $unsortables = ['kota_id'];

    public function __construct(Model $model, Kota $kota, $base = 'kecamatan')
    {
        parent::__construct($model, $base);
     
        $this->kota = $kota;
     
        $this->breadcrumb2Icon  = 'map';
        $this->fields           = array_merge(array_except($this->model->getFields(), ['id']), ['kota_id' => 'Kota']);
     
        $this->view->share(get_object_vars($this));
    }

    protected function processDatatables($datatables)
    {
        return $datatables
            ->editColumn('kota_id', function ($data) {
                return $data->kota->kota.' - '.$data->kota->propinsi->propinsi;
            });
    }

    protected function processRequest($request)
    {
        $kota_id = $request->get('kota');
        $request->merge(compact('kota_id'));
     
        return $request;
    }

    protected function loadFormClasses()
    {
        $kotas = [];

        foreach ($this->kota->get()->keyBy('id') as $id => $kota) {
            $kotas[$id] = $kota->kota.' - '.$kota->propinsi->propinsi;
        };

        $this->kotas = $kotas;
        $this->view->share(get_object_vars($this));
    }
}
