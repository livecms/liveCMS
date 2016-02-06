<?php

namespace App\Models;

class Tag extends BaseModel
{
    protected $fillable = ['tag', 'slug'];

    public function rules()
    {
        $slug = str_slug(request()->has('slug') ? request()->get('slug') : request()->get('tag'));

        request()->merge(compact('slug'));

        return [
            'tag' => 'required|unique:tags,tag'.(($this->id != null) ? ','.$this->id : ''),
            'slug' => 'required|unique:tags,slug'.(($this->id != null) ? ','.$this->id : ''),
        ];
    }
}
