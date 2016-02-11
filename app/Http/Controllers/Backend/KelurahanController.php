<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BackendController;
use App\Models\Kelurahan as Model;
use App\Models\Kecamatan;

class KelurahanController extends BackendController
{
    protected $kecamatan;
    protected $unsortables = ['kecamatan_id'];

    public function __construct(Model $model, Kecamatan $kecamatan, $base = 'kelurahan')
    {
        parent::__construct($model, $base);
        $this->kecamatan = $kecamatan;
     
        $this->breadcrumb2Icon  = 'map';
        $this->fields           = array_merge(array_except($this->model->getFields(), ['id']), ['kecamatan_id' => 'Kecamatan']);
     
        $this->view->share(get_object_vars($this));
    }

    protected function processDatatables($datatables)
    {
        return $datatables
            ->editColumn('kecamatan_id', function ($data) {
                return $data->kecamatan->kecamatan.', '.$data->kecamatan->kota->kota.' - '.$data->kecamatan->kota->propinsi->propinsi;
            });
    }

    protected function processRequest($request)
    {
        $kecamatan_id = $request->get('kecamatan');
        $request->merge(compact('kecamatan_id'));
     
        return $request;
    }

    protected function loadFormClasses()
    {
        $kecamatans = [];
     
        foreach ($this->kecamatan->get()->keyBy('id') as $id => $kecamatan) {
            $kecamatans[$id] = $kecamatan->kecamatan.', '.$kecamatan->kota->kota.' - '.$kecamatan->kota->propinsi->propinsi;
        };
     
        $this->kecamatans = $kecamatans;
        $this->view->share(get_object_vars($this));
    }
}
