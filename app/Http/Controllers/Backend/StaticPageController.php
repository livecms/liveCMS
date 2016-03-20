<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\liveCMS\Controllers\BackendController;
use App\Models\StaticPage as Model;
use App\Models\Permalink;

class StaticPageController extends BackendController
{
    protected $unsortables = ['tag', 'kategori'];

    public function __construct(Model $model, $base = 'static_page')
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
                return '<a target="_blank" href="'.$data->url.'">'.$data->judul.'</a>';
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
