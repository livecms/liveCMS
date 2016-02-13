<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\liveCMS\Views\BackendView;

class BaseController extends Controller
{
    public $global_params;

    protected $view;

    public function __construct()
    {
        $this->global_params = globalParams();
        $this->view = new BackendView($this);
    }

    public function getAllProperties()
    {
        return get_object_vars($this);
    }
}
