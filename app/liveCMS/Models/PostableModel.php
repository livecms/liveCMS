<?php

namespace App\liveCMS\Models;

use App\liveCMS\Models\Users\User as UserModel;
use Carbon\Carbon;

class PostableModel extends BaseModel
{
    protected $fillable = ['title', 'site_id', 'slug', 'content', 'author_id', 'picture', 'published_at'];

    protected $appends = ['url'];

    protected $dependencies = ['permalink', 'author'];

    protected $dates = ['published_at'];

    protected $prefixSlug = '';

    protected $aliases = ['author_id' => 'Author'];

    protected static $picturePath = 'files';
 
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
        return $this->belongsTo(UserModel::class, 'author_id');
    }

    public function permalink()
    {
        return $this->morphOne(Permalink::class, 'postable');
    }

    public function children()
    {
        //
    }

    public function getUrlAttribute()
    {
        if ($this->permalink && $this->permalink->permalink) {

            return url($this->permalink->permalink);
        }

        if ($this->slug != null) {
            
            return url($this->prefixSlug.'/'.$this->slug);
        }

        return url($this->prefixSlug);
    }

    public function getPicturePath()
    {
        return static::$picturePath;
    }

    public function getPictureAttribute($picture)
    {
        return $picture ? asset($this->getPicturePath().'/'.$picture) : null;
    }

    public function getContent()
    {
        return $this->content;
    }
}
