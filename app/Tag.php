<?php

namespace App;

class Tag extends BaseModel
{
    protected $fillable = ['tag', 'slug'];

    public function rules()
    {
    	if (!request()->has('slug')) request()->merge(['slug' => str_slug(request()->get('tag'))]);

    	return [
    		'tag' => 'required|unique:tags,tag'.(($this->id != null) ? ','.$this->id : ''),
    		'slug' => 'required|unique:tags,slug'.(($this->id != null) ? ','.$this->id : ''),
    	];
    }
}
