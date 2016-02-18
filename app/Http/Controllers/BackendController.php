<?php

namespace App\Http\Controllers;

use Form;
use Datatables;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\liveCMS\Models\BaseModelInterface as Model;

class BackendController extends BaseController
{
    const CLASS_NAMESPACE = 'Backend\\';
    protected $model;
    protected $base;
    protected $baseClass;


    public function __construct(Model $model, $base = '')
    {
        parent::__construct();

        $this->model = $model;
        $this->base = $base;
        $this->baseClass = static::CLASS_NAMESPACE.(new \ReflectionClass($this))->getShortName();

        $this->fields           = $this->model->getFields();
        $this->breadcrumb2      = ucwords(snakeToStr($this->base));
        $this->breadcrumb2Url   = action($this->baseClass.'@getIndex');
        
        $this->view->share();
    }

    protected function processDatatables($datatables)
    {
        return $datatables;
    }

    protected function processRequest($request)
    {
        return $request;
    }

    protected function loadFormClasses()
    {
        //
    }

    protected function afterSaving($model, $request)
    {
        return $model;
    }

    public function getIndex()
    {
        $this->judul        = ucwords(snakeToStr($this->base));
        $this->deskripsi    = 'Semua Daftar '.ucwords(snakeToStr($this->base));
        $this->breadcrumb3  = 'Lihat Semua';

        $this->view->share();

        return view('partials.appIndex');
    }

    public function anyData()
    {
        $datas = $this->model->select([null => $this->model->getKeyName()]+$this->model->getFillable());

        // if ($dependencies = $this->model->dependencies()) {
        //     $datas = $datas->with($dependencies);
        // }

        $datatables = Datatables::of($datas)
            ->addColumn('menu', function ($data) {
                return
                    '<a href="'.action($this->baseClass.'@getEdit', [$data->{$this->model->getKeyName()}]).'" 
                        class="btn btn-small btn-link">
                            <i class="fa fa-xs fa-pencil"></i> 
                            Edit
                    </a> '.
                    Form::open(['style' => 'display: inline!important', 'method' => 'delete', 
                        'action' => [$this->baseClass.'@deleteHapus', $data->{$this->model->getKeyName()}]
                    ]).
                    '  <button type="submit" onClick="return confirm(\'Yakin mau menghapus?\');" 
                        class="btn btn-small btn-link">
                            <i class="fa fa-xs fa-trash-o"></i> 
                            Delete
                    </button>
                    </form>';
            });
        $datatables = $this->processDatatables($datatables);
        $result = $datatables
            ->make(true);

        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTambah()
    {
        $model = $this->model;
        ${$this->base} = $model;

        $this->judul        = 'Tambah Data '.ucwords(snakeToStr($this->base));
        $this->deskripsi    = 'Untuk menambahkan data '.snakeToStr($this->base);
        $this->breadcrumb3  = 'Tambah';
        $this->action       = 'postTambah';

        $this->view->share();

        $this->loadFormClasses();

        return view("admin.{$this->base}.form", compact($this->base));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postTambah(Request $request)
    {
        $request = $this->processRequest($request);

        $this->validate($request, $this->model->rules());

        $created = $this->model->create($request->all());

        $saved = $this->afterSaving($created, $request);

        if ($saved) {
            return redirect()->action($this->baseClass.'@getIndex');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $model = $this->model->findOrFail($id);
        ${$this->base} = $model;

        $this->judul        = 'Edit '.ucwords(snakeToStr($this->base));
        $this->deskripsi    = 'Mengedit data '.snakeToStr($this->base);
        $this->breadcrumb3  = 'Edit';
        $this->action       = 'postEdit';
        $this->params       = compact('id');
        
        $this->view->share();
        
        $this->loadFormClasses();

        return view("admin.{$this->base}.form", compact($this->base));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postEdit(Request $request, $id)
    {
        $model = $this->model->where($this->model->getKeyName(), $id)->first();

        $model = $this->model->findOrFail($id);

        $request = $this->processRequest($request);

        $this->validate($request, $model->rules());

        $model->update($request->all());

        $saved = $this->afterSaving($model, $request);

        if ($saved) {
            return redirect()->action($this->baseClass.'@getIndex');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteHapus($id)
    {
        $model = $this->model->where($this->model->getKeyName(), $id)->first();

        $model = $this->model->findOrFail($id);

        $deleted = $model->delete();

        if ($deleted) {
            return redirect()->action($this->baseClass.'@getIndex');
        }
    }
}
