<?php

namespace App\Models;

use App\liveCMS\Models\PostableModel;
use App\liveCMS\Models\Permalink;

class Artikel extends PostableModel
{
    protected $dependencies = ['kategoris', 'tags', 'permalink'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
     
        $this->prefixSlug = globalParams('slug_artikel', config('livecms.slugs.artikel'));
    }

    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'artikel_kategoris');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'artikel_tags');
    }

    public function permalink()
    {
        return $this->morphOne(Permalink::class, 'postable');
    }
}
