<?php

namespace App;

class Artikel extends BaseModel
{
    protected $fillable = ['judul', 'slug', 'isi'];

    public function rules()
    {
    	if (!request()->has('slug')) request()->merge(['slug' => str_slug(request()->get('judul'))]);

    	return [
    		'judul' => 'required|unique:artikels,judul'.(($this->id != null) ? ','.$this->id : ''),
    		'slug' => 'required|unique:artikels,slug'.(($this->id != null) ? ','.$this->id : ''),
    		'isi' => 'required',
    	];
    }
    
}
