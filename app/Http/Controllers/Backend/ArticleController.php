<?php

namespace App\Http\Controllers\Backend;

use App\liveCMS\Controllers\Backend\PostableController;
use App\liveCMS\Models\Permalink;
use App\Models\Article as Model;
use App\Models\Category;
use App\Models\Tag;

class ArticleController extends PostableController
{
    protected $category;
    protected $tag;
    protected $permalink;
    protected $unsortables = ['tag', 'category'];

    public function __construct(Model $model, Category $category, Tag $tag, $base = 'article')
    {
        parent::__construct($model, $base);
        $this->category = $category;
        $this->tag = $tag;

        $this->breadcrumb2Icon  = 'files-o';
        $this->fields           = array_merge($this->model->getFields(), ['category' => 'Category', 'tag' => 'Tag']);
        
        $this->view->share();
    }

    protected function processDatatables($datatables)
    {
        return $datatables
            ->editColumn('title', function ($data) {
                return '<a target="_blank" href="'.$data->url.'">'.$data->title.'</a>';
            })
            ->editColumn('content', function ($data) {
                return str_limit(strip_tags($data->content), 300);
            })
            ->addColumn('category', function ($data) {
                return rtrim(implode(', ', $data->categories->lists('category')->toArray()), ', ');
            })
            ->addColumn('tag', function ($data) {
                return rtrim(implode(', ', $data->tags->lists('tag')->toArray()), ', ');
            });
    }

    protected function loadFormClasses()
    {
        $this->categories   = $this->category->lists('category', 'id')->toArray();
        $this->tags         = $this->tag->lists('tag', 'id')->toArray();
        
        parent::loadFormClasses();
    }
}
