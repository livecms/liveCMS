<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BackendController;
use App\Models\StaticPage as Model;

class StaticPageController extends BackendController
{
    protected $unsortables = ['tag', 'kategori'];

    public function __construct(Model $model, $base = 'static_page')
    {
        parent::__construct($model, $base);
        
        $this->breadcrumb2Icon  = 'files-o';        
        $this->view->share();
    }

    protected function loadFormClasses()
    {
        $this->useCKEditor  = 'isi';
     
        $this->view->share();
    }
}
