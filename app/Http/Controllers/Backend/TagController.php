<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BackendController;
use App\Tag as Model;

class TagController extends BackendController
{
    public function __construct(Model $model, $base = 'tag')
	{
		parent::__construct($model, $base);
    	view()->share('breadcrumb2Icon', 'tag');
	}
}
