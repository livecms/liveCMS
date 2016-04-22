<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\liveCMS\Controllers\UserController;
use App\Models\Article as Model;

class ArticleController extends UserController
{
    public function __construct(Model $model, $base = 'myarticle')
    {
        $this->breadcrumb2Icon  = 'pencil';
        parent::__construct($model, $base);
        $this->fields = ['title', 'permalink', 'picture', 'published at'];
        // $this->model = $this->model->setAllSites(false);
    }

    public function index(Request $request)
    {
        $this->title        = title_case(trans('livecms.myarticle'));
        $this->description  = trans('backend.alllist', ['list' => title_case(trans('livecms.'.$this->base))]);
        $this->breadcrumb2  = trans('livecms.myarticle');
        $this->breadcrumb3  = trans('backend.seeall');
        $this->view->share();
        return view('user.myarticle.home', compact(camel_case($this->base)));
    }

    public function create(Request $request)
    {
        $model = $this->model;
        ${camel_case($this->base)} = $model;

        $this->title        = trans('backend.add');
        $this->description  = trans('backend.adding', ['data' => trans('livecms.'.$this->base)]);
        $this->breadcrumb3  = trans('backend.add');
        $this->action       = 'store';
        $this->params       = array_merge($request->query() ? $request->query() : []);

        $this->view->share();

        $this->loadFormClasses($model);

        return view("user.".camel_case($this->base).".form", compact(camel_case($this->base)));
    }    

}
