<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Backend\ArticleController as Senior;
use App\Models\UserArticle as Model;
use App\Models\Category;
use App\Models\Tag;

class ArticleController extends Senior
{
    public function __construct(Model $model, Category $category, Tag $tag, $base = 'myarticle')
    {
        parent::__construct($model, $category, $tag, $base);
        $this->model = $this->model->selfPost();
        $this->fields = array_except($this->fields, ['id', 'slug', 'author_id', 'category', 'tag', 'content']);
        $this->bodyClass = 'skin-blue sidebar-mini sidebar-collapse';

        $this->withoutHeader = true;
        // $this->model = $this->model->setAllSites(false);
    }

    public function index(Request $request)
    {
        parent::index($request);
        return view('user.myarticle.home', compact(camel_case($this->base)));
    }

    public function create(Request $request)
    {
        $model = $this->model;
        ${camel_case($this->base)} = $model;

        $this->title        = trans('backend.newarticle');
        $this->action       = 'store';
        $this->params       = array_merge($request->query() ? $request->query() : []);

        $this->view->share();

        $this->loadFormClasses($model);
        return view("user.".camel_case($this->base).".form", compact(camel_case($this->base)));
    }

    public function edit(Request $request, $id)
    {
        $model = $this->model->findOrFail($id);
        ${camel_case($this->base)} = $model;

        $this->title        = trans('backend.editdata', ['data' => title_case(trans('livecms.'.$this->base))]);
        $this->description  = trans('backend.editingdata', ['data' => trans('livecms.'.$this->base)]);
        $this->breadcrumb3  = trans('backend.edit');
        $this->action       = 'update';
        $this->params       = array_merge($request->query() ? $request->query() : [], compact('id'));
        
        $this->view->share();
        
        $this->loadFormClasses($model);
        return view("user.".camel_case($this->base).".form", compact(camel_case($this->base)));
    }
}
