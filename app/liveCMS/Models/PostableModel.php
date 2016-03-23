<?php

namespace App\liveCMS\Models;

use Carbon\Carbon;

class PostableModel extends BaseModel
{
    protected $fillable = ['title', 'site_id', 'slug', 'content', 'author_id', 'picture', 'published_at'];

    protected $dependencies = ['permalink'];

    protected $dates = ['published_at'];

    protected $prefixSlug = '';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function rules()
    {
        $this->slugify('title');

        $published_at = $this->published_at ?: Carbon::now();

        $author_id = $this->author_id ?: auth()->user()->id;

        request()->merge(compact('published_at', 'author_id'));

        return [
            'title' => $this->uniqify('title'),
            'slug' => $this->uniqify('slug'),
            'content' => 'required',
            'picture' => 'image|max:5120',
            'published_at' => 'required',
        ];
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function permalink()
    {
        return $this->morphOne(Permalink::class, 'postable');
    }

    public function getUrlAttribute()
    {
        if ($this->permalink && $this->permalink->permalink) {

            return url($this->permalink->permalink);
        }

        if ($this->slug != null) {
            
            return url($this->prefixSlug.'/'.$this->slug);
        }

        return '';
    }
}
