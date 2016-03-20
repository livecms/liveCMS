<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\liveCMS\Controllers\BackendController;
use App\Models\Artikel as Model;
use App\Models\Kategori;
use App\Models\Permalink;
use App\Models\Tag;

class ArtikelController extends BackendController
{
    protected $kategori;
    protected $tag;
    protected $permalink;
    protected $unsortables = ['tag', 'kategori'];

    public function __construct(Model $model, Kategori $kategori, Tag $tag, $base = 'artikel')
    {
        parent::__construct($model, $base);
        $this->kategori = $kategori;
        $this->tag = $tag;

        $this->breadcrumb2Icon  = 'files-o';
        $this->fields           = array_merge($this->model->getFields(), ['kategori' => 'Kategori', 'tag' => 'Tag']);
        
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
            })
            ->editColumn('isi', function ($data) {
                return str_limit(strip_tags($data->isi), 300);
            })
            ->addColumn('kategori', function ($data) {
                return rtrim(implode(', ', $data->kategoris->lists('kategori')->toArray()), ', ');
            })
            ->addColumn('tag', function ($data) {
                return rtrim(implode(', ', $data->tags->lists('tag')->toArray()), ', ');
            });
    }

    protected function loadFormClasses()
    {
        $this->kategoris    = $this->kategori->lists('kategori', 'id')->toArray();
        $this->tags         = $this->tag->lists('tag', 'id')->toArray();
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
        $this->model->kategoris()->sync($request->get('kategoris', []));
        $this->model->tags()->sync($request->get('tags', []));

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
