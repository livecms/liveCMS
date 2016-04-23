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

        $this->formLeftWidth = 2;
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
        $categories = $request->get('categories', []);

        $newCategories = [];

        foreach ($categories as $index => $category) {
            if (is_numeric($category) && $this->category->find($category)) {
                continue;
            }

            $cat = $this->category->firstOrNew(['category' => $category]);

            if (!$cat->id) {

                $i = 0;
                do {
                    $slug = str_slug($cat->category).($i++ > 0 ? '-'.$i : '');
                } while ($this->category->where('slug', $slug)->first());

                $cat->slug = $slug;
                $cat->save();
            }

            $newCategories[$index] = $cat->id;
        }

        $categories = array_replace($categories, $newCategories);

        $tags = $request->get('tags', []);

        $newTags = [];

        foreach ($tags as $index => $tag) {
            
            if (is_numeric($tag) && $this->tag->find($tag)) {
                continue;
            }

            $tag = $this->tag->firstOrNew(['tag' => $tag]);

            if (!$tag->id) {

                $i = 0;
                do {
                    $slug = str_slug($tag->tag).($i++ > 0 ? '-'.$i : '');
                } while ($this->tag->where('slug', $slug)->first());
                
                $tag->slug = $slug;
                $tag->save();
            }

            $newTags[$index] = $tag->id;
        }

        $tags = array_replace($tags, $newTags);

        $request->merge(compact('categories', 'tags'));

        $this->model->categories()->sync($request->get('categories', []));
        $this->model->tags()->sync($request->get('tags', []));

        return parent::afterSaving($request);
    }
}
