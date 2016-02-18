<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Artikel;
use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;

class PageController extends FrontendController
{
    public function getArtikel($slug)
    {
        $artikel = Artikel::where('slug', $slug)->firstOrFail();

        return $artikel;
    }

    public function __call($method, $parameters = null)
    {
        $parameters = func_get_args();

        $artikelSlug = globalParams('artikel_slug', config('livecms.slugs.artikel'));

        if ($parameters[0] == $artikelSlug) {
            return $this->getArtikel($parameters[1]);
        }


        $statisSlug = globalParams('statis_slug', config('livecms.slugs.statis'));

        if ($parameters[0] == $statisSlug) {
            return $this->getStatis($parameters[1]);
        }

        return parent::__call($method, $parameters);
    }
}
