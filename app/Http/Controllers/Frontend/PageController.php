<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Article;
use App\Models\StaticPage;
use App\liveCMS\Models\Permalink;
use App\liveCMS\Controllers\FrontendController;
use Illuminate\Http\Request;

class PageController extends FrontendController
{
    public function getArticle($slug = null)
    {
        if ($slug == null) {

            $articles = Article::orderBy('published_at', 'DESC')->simplePaginate(1);

            return view(theme('front', (request()->ajax() ? 'partials.articles' : 'articles')), compact('articles'));

        }

        $post = $article = Article::where('slug', $slug)->firstOrFail();

        return view(theme('front', 'article'), compact('post', 'article'));
    }

    public function getStatis($slug = null)
    {
        $post = $statis = StaticPage::where('slug', $slug)->firstOrFail();

        return view(theme('front', 'staticpage'), compact('post', 'statis'));
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
            $param = isset($parameters[1]) ? $parameters[1] : null;
            return $this->getArticle($param);
        }


        $statisSlug = globalParams('staticpage_slug', config('livecms.slugs.staticpage'));

        if ($parameters[0] == $statisSlug) {
            return $this->getStatis($parameters[1]);
        }

        $permalink = implode('/', $parameters);

        return $this->getByPermalink($permalink);
    }
}
