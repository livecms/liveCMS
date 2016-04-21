<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\liveCMS\Controllers\UserController;
use App\Models\Article as Model;

class ArticleController extends UserController
{
    public function __construct(Model $model, $base = 'article')
    {
        $this->breadcrumb2Icon  = 'pencil';
        parent::__construct($model, $base);
        // $this->model = $this->model->setAllSites(false);
    }

    public function index(Request $request)
    {
        parent::index($request);

        return view('user.article.home', compact(camel_case($this->base)));
    }

}
