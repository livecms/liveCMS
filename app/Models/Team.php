<?php

namespace App\Models;

use Carbon\Carbon;
use App\liveCMS\Models\PostableModel;
use App\liveCMS\Models\Traits\AdminModelTrait;

class Team extends PostableModel
{
    use AdminModelTrait;

    protected $fillable = ['name', 'role', 'site_id', 'slug', 'description', 'author_id', 'picture'];

    protected $excepts = ['author_id'];
    
    protected $dependencies = ['socials'];
 
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
     
        $this->prefixSlug = globalParams('slug_team', config('livecms.slugs.team'));
    }

    public function rules()
    {
        $this->slugify('name');

        $published_at = $this->published_at ?: Carbon::now();

        $author_id = $this->author_id ?: auth()->user()->id;

        request()->merge(compact('published_at', 'author_id'));

        return [
            'name' => 'required',
            'role' => 'required',
            'slug' => $this->uniqify('slug'),
            'description' => 'required',
            'picture' => 'image|max:5120',
            'published_at' => 'required',
        ];
    }

    public function socials()
    {
        return $this->belongsToMany(TeamMediaSocial::class, 'team_team_media_socials', 'team_id', 'team_media_social_id');
    }
}
