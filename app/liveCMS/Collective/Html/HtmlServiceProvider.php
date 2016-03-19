<?php

namespace App\liveCMS\Collective\Html;

use Collective\Html\HtmlServiceProvider as ServiceProvider;

class HtmlServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerHtmlBuilder();

        $this->registerFormBuilder();

        $this->app->alias('html', 'Collective\Html\HtmlBuilder');
        $this->app->alias('form', 'App\liveCMS\Collective\Html\FormBuilder');
    }
}
