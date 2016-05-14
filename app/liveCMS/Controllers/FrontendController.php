<?php

namespace App\liveCMS\Controllers;

use Illuminate\Http\Request;

class FrontendController extends BaseController
{
    public function __construct()
    {
        $helpers = config('view.paths.0').DIRECTORY_SEPARATOR.str_replace('.', DIRECTORY_SEPARATOR, theme('front', 'partials.helpers')).'.php';
        $variables = file_exists($helpers) ? require_once $helpers : [];
        view()->share($variables);
    }
}
