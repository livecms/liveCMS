<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BackendController;
use App\Kategori as Model;

class KategoriController extends BackendController
{
	protected function processRequest($request)
    {
    	$slug = $request->input('slug', $request->input('kategori'));

    	if (empty(trim($slug))) $slug = $request->get('kategori'); 

    	$slug = str_slug($slug);

    	$request->merge(compact('slug'));
    	
    	return $request;
    }


    public function __construct(Model $model, $base = 'kategori')
	{
		parent::__construct($model, $base);
    	view()->share('breadcrumb2Icon', 'list');
        view()->share('fields', array_except($this->model->getFields(), ['id']));
	}

}
