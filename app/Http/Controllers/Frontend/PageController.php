<?php

namespace App\Http\Controllers\Frontend;


use Illuminate\Http\Request;
use App\Http\Controllers\FrontendController;

class PageController extends FrontendController
{
    public function __call($method, $parameters = null)
    {
        return func_get_args();
    }
}
