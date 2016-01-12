<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BackendController;
use App\Tag as Model;

class TagController extends BackendController
{	
    protected function processRequest($request)
    {
    	$slug = $request->input('slug', $request->input('tag'));

    	if (empty(trim($slug))) $slug = $request->get('tag'); 

    	$slug = str_slug($slug);

    	$request->merge(compact('slug'));
    	
    	return $request;
    }

    public function __construct(Model $model, $base = 'tag')
	{
		parent::__construct($model, $base);
    	view()->share('breadcrumb2Icon', 'tag');
	}
}
