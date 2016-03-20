<?php

namespace App\liveCMS\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\liveCMS\Controllers\BackendController;
use App\liveCMS\Models\BaseModel as Model;
use App\liveCMS\Models\Permalink;

abstract class PostableController extends BackendController
{
    public function __construct(Model $model, $base = 'post')
    {
        parent::__construct($model, $base);
        
        $this->breadcrumb2Icon  = 'file-o';
        $this->view->share();
    }

    protected function beforeDatatables($datas)
    {
        return $datas->with($this->model->dependencies());
    }

    protected function processDatatables($datatables)
    {
        return $datatables
            ->editColumn('judul', function ($data) {
                return '<a target="_blank"  href="'.$data->url.'">'.$data->judul.'</a>';
            });
    }

    protected function loadFormClasses()
    {
        $this->useCKEditor  = 'isi';
     
        $this->view->share();
    }

    public function processRequest($request)
    {
        if ($request->has('permalink')) {
            
            if ($this->model->permalink !== null) {
            
                $this->validate($request, $this->model->permalink->rules());
            
            } else {

                $this->validate($request, (new Permalink)->rules());
            }
        }

        return $request;
    }

    protected function afterSaving($request)
    {
        if ($request->has('permalink')) {
            
            $permalink = $this->model->permalink;

            if ($permalink == null) {
                $permalink = new Permalink();
                $permalink->postable()->associate($this->model);
                $permalink->save();
            }

            $permalink->update(['permalink' => $request->get('permalink')]);
        
        } else {

            if ($this->model->permalink) {
                $this->model->permalink->delete();
            }
        }

        return $this->model;
    }
}
