<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Artikel;
use App\Models\Permalink;
use App\Models\StaticPage;
use App\liveCMS\Controllers\FrontendController;
use Illuminate\Http\Request;

class PageController extends FrontendController
{
    public function getArtikel($slug)
    {
        $artikel = Artikel::where('slug', $slug)->firstOrFail();

        return $artikel;
    }

    public function getStatis($slug)
    {
        $statis = StaticPage::where('slug', $slug)->firstOrFail();

        return $statis;
    }

    public function getByPermalink($permalink)
    {
        $page = Permalink::where('permalink', $permalink)->firstOrFail();

        return $page->postable;
    }

    public function routes()
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

        $permalink = implode('/', $parameters);

        return $this->getByPermalink($permalink);
    }
}
