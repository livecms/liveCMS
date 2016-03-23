<?php

namespace App\liveCMS\Routing;

use Illuminate\Routing\Router as OriginalRouter;

class Router extends OriginalRouter
{
    /**
     * Route a resource to a controller.
     *
     * @param  string  $name
     * @param  string  $controller
     * @param  array   $options
     * @return void
     */
    public function resource($name, $controller, array $options = [])
    {
        if ($this->container && $this->container->bound('App\liveCMS\Routing\ResourceRegistrar')) {
            $registrar = $this->container->make('App\liveCMS\Routing\ResourceRegistrar');
        } else {
            $registrar = new ResourceRegistrar($this);
        }

        $registrar->register($name, $controller, $options);
    }
}
