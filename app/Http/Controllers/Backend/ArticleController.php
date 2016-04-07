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

    public function __construct(Model $model, Category $category, Tag $tag, $base = 'article')
    {
        parent::__construct($model, $base);

        $this->unsortables = array_merge($this->unsortables, ['tag', 'category']);

        $this->category = $category;
        $this->tag = $tag;

        $this->breadcrumb2Icon  = 'files-o';
        
        $this->view->share();
    }

    protected function processDatatables($datatables)
    {
        $datatables = parent::processDatatables($datatables);
        
        return $datatables
            ->addColumn('category', function ($data) {
                return dataImplode($data->categories, 'category');
            })
            ->addColumn('tag', function ($data) {
                return dataImplode($data->tags, 'tag');
            });
    }

    protected function loadFormClasses($model)
    {
        $this->categories   = $this->category->pluck('category', 'id')->toArray();
        $this->tags         = $this->tag->pluck('tag', 'id')->toArray();
        
        parent::loadFormClasses($model);
    }

    protected function afterSaving($request)
    {
        $this->model->categories()->sync($request->get('categories', []));
        $this->model->tags()->sync($request->get('tags', []));

        return parent::afterSaving($request);
    }
}
