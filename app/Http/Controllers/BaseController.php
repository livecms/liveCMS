<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Cache;
use View;
use App\Setting as Param;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public $global_params;

    public function __construct()
    {
        $global_params = Cache::rememberForever('global_params', function() {
            return Param::lists('value', 'key');
        });

        $this->global_params = $global_params;
    }
}
