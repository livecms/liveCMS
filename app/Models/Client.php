<?php

namespace App\Models;

use Carbon\Carbon;
use App\liveCMS\Models\PostableModel;

class Client extends PostableModel
{
    protected $fillable = ['name', 'site_id', 'slug', 'description', 'author_id', 'picture'];

    protected $mergesAfter = ['project' => 'Project'];

    protected $excepts = ['author_id'];

    protected $dependencies = ['projects'];
 
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
     
        $this->prefixSlug = globalParams('slug_client', config('livecms.slugs.client'));
    }

    public function rules()
    {
        $this->slugify('name');

        $published_at = $this->published_at ?: Carbon::now();

        $author_id = $this->author_id ?: auth()->user()->id;

        request()->merge(compact('published_at', 'author_id'));

        return [
            'name' => 'required',
            'slug' => $this->uniqify('slug'),
            'description' => 'required',
            'picture' => 'image|max:5120',
            'published_at' => 'required',
        ];
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
