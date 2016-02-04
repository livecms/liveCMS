<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BackendController;
use App\Artikel as Model;
use App\Kategori;
use App\Tag;

class ArtikelController extends BackendController
{
    protected $kategori;
    protected $tag;
    protected $unsortables = ['tag', 'kategori'];

    public function __construct(Model $model, $base = 'artikel', Kategori $kategori, Tag $tag)
    {
        parent::__construct($model, $base);
        $this->kategori = $kategori;
        $this->tag = $tag;
        view()->share('breadcrumb2Icon', 'file-o');
        view()->share('fields', array_merge($this->model->getFields(), ['kategori' => 'Kategori', 'tag' => 'Tag']));
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
        view()->share('kategoris', $this->kategori->lists('kategori', 'id')->toArray());
        view()->share('tags', $this->tag->lists('tag', 'id')->toArray());
        view()->share('useCKEditor', 'isi');
    }

    protected function afterSaving($model, $request)
    {
        $model->kategoris()->sync($request->get('kategoris', []));
        $model->tags()->sync($request->get('tags', []));

        return $model;
    }
}
