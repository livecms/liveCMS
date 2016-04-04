<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Article;
use App\Models\StaticPage;
use App\liveCMS\Models\Permalink;
use App\liveCMS\Controllers\FrontendController;
use Illuminate\Http\Request;

class PageController extends FrontendController
{
    public function getArticle($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        return view('article', $article);
    }

    public function getStatis($slug)
    {
        $statis = StaticPage::where('slug', $slug)->firstOrFail();

        return view('staticpage', $statis);
    }

    public function getByPermalink($permalink)
    {
        $page = Permalink::where('permalink', $permalink)->firstOrFail();

        $type = strtolower(basename($page->portable_type));

        return view(theme('front', $permalink), ['post' => $page->postable]);
    }

    public function routes()
    {
        $parameters = func_get_args();

        $articleSlug = globalParams('article_slug', config('livecms.slugs.article'));

        if ($parameters[0] == $articleSlug) {
            return $this->getArticle($parameters[1]);
        }


        $statisSlug = globalParams('staticpage_slug', config('livecms.slugs.staticpage'));

        if ($parameters[0] == $statisSlug) {
            return $this->getStatis($parameters[1]);
        }

        $permalink = implode('/', $parameters);

        return $this->getByPermalink($permalink);
    }
}
