<?php

namespace App\Http\Controllers\Backend;

use App\liveCMS\Controllers\Backend\PostableController;
use App\Models\Gallery as Model;

class GalleryController extends PostableController
{
    protected $permalink;

    public function __construct(Model $model, $base = 'gallery')
    {
        parent::__construct($model, $base);

        $this->breadcrumb2Icon  = 'images';

        $this->view->share();
    }
}
