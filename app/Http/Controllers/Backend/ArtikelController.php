<?php

namespace App\Http\Controllers\Backend;

use App\liveCMS\Controllers\Backend\PostableController;
use App\liveCMS\Models\Permalink;
use App\Models\Artikel as Model;
use App\Models\Kategori;
use App\Models\Tag;

class ArtikelController extends PostableController
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
        
        parent::loadFormClasses();
    }
}
