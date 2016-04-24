<?php

namespace App\Models;

use App\liveCMS\Models\PostableModel;
use App\liveCMS\Models\Permalink;
use App\liveCMS\Models\Traits\AuthorModelTrait;
use App\liveCMS\Models\User;

class Article extends PostableModel
{
    use AuthorModelTrait;
    
    protected $mergesAfter = ['category' => 'Category', 'tag' => 'Tag'];

    protected $dependencies = ['author', 'categories', 'tags', 'permalink'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
     
        $this->prefixSlug = globalParams('slug_article', config('livecms.slugs.article'));
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'article_categories', 'article_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tags', 'article_id');
    }

    public function permalink()
    {
        return $this->morphOne(Permalink::class, 'postable');
    }
}
