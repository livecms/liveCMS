<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public $global_params;

    public function __construct()
    {
        $this->global_params = globalParams();
    }
}
