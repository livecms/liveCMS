<?php

namespace App\Models;

use App\liveCMS\Models\PostableModel;

class StaticPage extends PostableModel
{    
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->fillable = array_merge($this->fillable, ['parent_id']);

        $this->dependencies = array_merge($this->dependencies, ['parent']);

        $this->aliases = array_merge($this->dependencies, ['parent_id' => 'Parent']);

        $this->prefixSlug = globalParams('slug_staticpage', config('livecms.slugs.staticpage'));
    }

    public function parent()
    {
        return $this->belongsTo(Static::class, 'parent_id');
    }

    public function rules()
    {
        $request = request();

        $parent_id = $request->has('parent') ? $request->get('parent') : $this->parent_id;
        
        request()->merge(compact('parent_id'));

        return parent::rules();
    }
}
