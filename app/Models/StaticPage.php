<?php

namespace App\Models;

class StaticPage extends BaseModel
{
    protected $fillable = ['judul', 'slug', 'isi'];

    protected $dependencies = ['permalink'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function rules()
    {
        $slug = str_slug(request()->has('slug') ? request()->get('slug') : request()->get('judul'));

        request()->merge(compact('slug'));

        return [
            'judul' => 'required|unique:'.$this->getTable().',judul'.(($this->id != null) ? ','.$this->id : ''),
            'slug' => 'required|unique:'.$this->getTable().',slug'.(($this->id != null) ? ','.$this->id : ''),
            'isi' => 'required',
        ];
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
            
            $prefix = globalParams('slug_statis', config('livecms.slugs.statis'));

            return url($prefix.DIRECTORY_SEPARATOR.$this->slug);
        }

        return '';
    }
}
