<?php

namespace App\liveCMS\Illuminate\Routing;

use Illuminate\Http\Request;
use Illuminate\Routing\RouteCollection;
use Illuminate\Routing\UrlGenerator as BaseUrlGenerator;
use Illuminate\Support\Str;

class UrlGenerator extends BaseUrlGenerator
{
    /**
     * Get the base URL for the request.
     *
     * @param  string  $scheme
     * @param  string  $root
     * @return string
     */
    protected function getRootUrl($scheme, $root = null)
    {
        $url = $this->request->root();

        $start = Str::startsWith($url, 'http://') ? 'http://' : 'https://';

        $site = site()->getCurrent();
        info(request()->segment(2));

        $this->cachedRoot = $this->forcedRoot = $start. $site->getHost().'/'.$site->subfolder;


        return parent::getRootUrl($scheme, $root);
    }

    /**
     * Generate an absolute URL to the given path.
     *
     * @param  string  $path
     * @param  mixed  $extra
     * @param  bool|null  $secure
     * @return string
     */
    public function to($path, $extra = [], $secure = null)
    {
        // First we will check if the URL is already a valid URL. If it is we will not
        // try to generate a new one but will simply return the URL as is, which is
        // convenient since developers do not always have to check if it's valid.
        if ($this->isValidUrl($path)) {
            return $path;
        }

        $path = ltrim($path, '/'.site()->getCurrent()->subfolder);

        return parent::to($path, $extra, $secure);
    }
}
