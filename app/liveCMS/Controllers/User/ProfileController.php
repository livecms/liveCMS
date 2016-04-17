<?php

namespace App\liveCMS\Controllers\User;

use Illuminate\Http\Request;
use App\liveCMS\Controllers\UserController;
use App\liveCMS\Models\Profile as Model;

class ProfileController extends UserController
{
    public function __construct(Model $model, $base = 'profile')
    {
        parent::__construct($model, $base);
        $this->model = $this->model->setAllSites(false);
        $this->breadcrumb2Icon  = 'user';
        
        $this->view->share();
    }

    public function index(Request $request)
    {
        $model = auth()->user();
        ${camel_case($this->base)} = $model;

        $this->title        = title_case(trans('livecms.'.$this->base));
        $this->description  = trans('backend.yourhomeprofile');
        $this->breadcrumb3  = trans('backend.homeprofile');
        $this->params       = array_merge($request->query() ? $request->query() : []);
        $this->action       = 'store';

        $this->view->share();

        return view('user.home', compact(camel_case($this->base)));
    }

    public function store(Request $request)
    {
        $id = auth()->user()->id;

        return $this->update($request, $id);
    }
}
