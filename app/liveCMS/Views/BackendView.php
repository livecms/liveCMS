<?php

namespace App\liveCMS\Views;

use Illuminate\Contracts\View\Factory as ViewFactory;
// use View;

class BackendView 
{
    protected $model;
    
    protected $base;

    protected $baseClass;
    
    protected $view;

    protected $fields;
    
    protected $unsortables = [];
    
    protected $orders = ['desc'];
    
    protected $judul;
        
    protected $deskripsi;

    protected $breadcrumbLevel = 3;
    
    protected $breadcrumb1 = 'App';

    protected $breadcrumb2;
    
    protected $breadcrumb2Url;

    protected $breadcrumb3;
 
    private $protectedFields = ['view'];

    public function __construct($settings = [])
    {
        $this->view = app(ViewFactory::class);

        $this->setDefaultSettings();

        return $this->share($settings);            
    }

    protected function setDefaultSettings()
    {
        $this->share([
            // 
        ]);
    }

    public function share($settings = [])
    {
        foreach ($settings as $key => $value) {
            if (! in_array($key, $this->protectedFields)) {
                $this->$key = $value;
            }
        }
    
        $this->view->share(get_object_vars($this));
        
        return $this;
    }
}
