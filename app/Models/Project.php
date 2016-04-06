<?php

namespace App\Models;

use App\liveCMS\Models\PostableModel;
use App\liveCMS\Models\Permalink;

class Project extends PostableModel
{
    protected $fillable = ['title', 'site_id', 'slug', 'content', 'author_id', 'picture', 'client_id'];

    protected $excepts = ['author_id', 'client_id'];

    protected $mergesBefore = ['client' => 'Client'];
    
    protected $dependencies = ['categories', 'client', 'permalink'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
     
        $this->prefixSlug = globalParams('slug_project', config('livecms.slugs.project'));
    }

    public function rules()
    {
        $rules = parent::rules();

        return array_merge($rules, ['client' => 'required']);
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
