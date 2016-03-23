<?php

namespace App\Http\Controllers\Backend;

use App\Models\StaticPage as Model;
use App\liveCMS\Controllers\Backend\PostableController;

class StaticPageController extends PostableController
{
    public function __construct(Model $model, $base = 'staticpage')
    {
        parent::__construct($model, $base);
    }
}
