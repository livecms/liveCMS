<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BackendController;
use App\Setting as Model;

class SettingController extends BackendController
{
    public function __construct(Model $model, $base = 'setting')
	{
		parent::__construct($model, $base);
    	view()->share('breadcrumb2Icon', 'cog');
	}
}
