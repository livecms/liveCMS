<?php

namespace App\Models;

use App\liveCMS\Models\PostableModel;
use App\liveCMS\Models\Permalink;

class Article extends PostableModel
{
    protected $mergesAfter = ['category' => 'Category', 'tag' => 'Tag'];

    protected $dependencies = ['categories', 'tags', 'permalink'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
     
        $this->prefixSlug = globalParams('slug_article', config('livecms.slugs.article'));
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'article_categories');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tags');
    }

    public function permalink()
    {
        return $this->morphOne(Permalink::class, 'postable');
    }
}
