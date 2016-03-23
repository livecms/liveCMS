<?php

namespace App\liveCMS\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\liveCMS\Controllers\BackendController;
use App\liveCMS\Models\PostableModel as Model;
use App\liveCMS\Models\Permalink;

abstract class PostableController extends BackendController
{
    protected static $picturePath = 'files';

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
            ->editColumn('title', function ($data) {
                return '<a target="_blank"  href="'.$data->url.'">'.$data->title.'</a>';
            });
    }

    protected function loadFormClasses()
    {
        $this->useCKEditor  = 'content';
     
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

    protected function deletePicture($picture)
    {
        $directory = $this->model->getPicturePath();
        $picturePath = public_path($directory.DIRECTORY_SEPARATOR.$picture);
        
        @unlink($picturePath);
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

        $oldPicture = $this->model->picture;

        if ($request->hasFile('picture') && $request->file('picture')->isValid()) {

            $destinationPath = public_path($this->model->getPicturePath());

            $extension = $request->file('picture')->getClientOriginalExtension();
            $picture = str_limit(str_slug($this->title.' '.date('YmdHis')), 200) . '.' . $extension;
            
            $result = $request->file('picture')->move($destinationPath, $picture);

            if ($result) {
                
                $this->model->update(compact('picture'));
                
                $this->deletePicture($oldPicture);
            }
        }

        return $this->model;
    }
}
