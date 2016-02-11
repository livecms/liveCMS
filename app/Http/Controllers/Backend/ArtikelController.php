<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BackendController;
use App\Models\Artikel as Model;
use App\Models\Kategori;
use App\Models\Tag;

class ArtikelController extends BackendController
{
    protected $kategori;
    protected $tag;
    protected $unsortables = ['tag', 'kategori'];

    public function __construct(Model $model, Kategori $kategori, Tag $tag, $base = 'artikel')
    {
        parent::__construct($model, $base);
        $this->kategori = $kategori;
        $this->tag = $tag;
        
        $this->breadcrumb2Icon  = 'file-o';
        $this->fields           = array_merge($this->model->getFields(), ['kategori' => 'Kategori', 'tag' => 'Tag']);
        
        $this->view->share(get_object_vars($this));
    }

    protected function processDatatables($datatables)
    {
        return $datatables
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
     
        $this->view->share(get_object_vars($this));
    }

    protected function afterSaving($model, $request)
    {
        $model->kategoris()->sync($request->get('kategoris', []));
        $model->tags()->sync($request->get('tags', []));

        return $model;
    }
}
