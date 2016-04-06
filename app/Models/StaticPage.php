<?php

namespace App\Models;

use App\liveCMS\Models\PostableModel;

class StaticPage extends PostableModel
{
    protected $mergesBefore = ['id' => 'id', 'parent' => 'parent'];

    protected $excepts = ['id', 'parent_id'];

    protected $dependencies = ['permalink', 'author', 'parent'];
   
    public function __construct(array $attributes = [])
    {
        $this->fillable = array_merge($this->fillable, ['parent_id']);

        $this->aliases = array_merge($this->aliases, ['parent_id' => 'Parent']);

        $this->prefixSlug = globalParams('slug_staticpage', config('livecms.slugs.staticpage'));

        parent::__construct($attributes);
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
