<?php

namespace App\Http\Controllers\Backend;

use App\Models\StaticPage as Model;
use App\liveCMS\Controllers\Backend\PostableController;

class StaticPageController extends PostableController
{
    public function __construct(Model $model, $base = 'static_page')
    {
        parent::__construct($model, $base);
    }
}
