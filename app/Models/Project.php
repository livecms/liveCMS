<?php

namespace App\Models;

use App\liveCMS\Models\PostableModel;
use App\liveCMS\Models\Permalink;

class Project extends PostableModel
{
    protected $dependencies = ['categories', 'client', 'permalink'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
     
        $this->prefixSlug = globalParams('slug_project', config('livecms.slugs.project'));
    }

    public function categories()
    {
        return $this->belongsToMany(ProjectCategory::class, 'project_project_categories', 'project_id', 'category_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function permalink()
    {
        return $this->morphOne(Permalink::class, 'postable');
    }
}
