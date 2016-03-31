<?php

namespace App\Models;

use App\liveCMS\Models\PostableModel;

class StaticPage extends PostableModel
{
    protected $dependencies = ['permalink', 'author', 'parent'];
   
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->fillable = array_merge($this->fillable, ['parent_id']);

        $this->aliases = array_merge($this->aliases, ['parent_id' => 'Parent']);

        $this->prefixSlug = globalParams('slug_staticpage', config('livecms.slugs.staticpage'));
    }

    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(static::class, 'parent_id');
    }
}
