<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BackendController;
use App\Artikel as Model;

class ArtikelController extends BackendController
{
    public function __construct(Model $model, $base = 'artikel')
	{
		parent::__construct($model, $base);
    	view()->share('breadcrumb2Icon', 'file-o');
    	view()->share('useCKEditor', 'isi');
	}
}
