<?php

namespace App;

class Kategori extends BaseModel
{
    protected $fillable = ['kategori', 'slug'];

    public function rules()
    {
    	if (!request()->has('slug')) request()->merge(['slug' => str_slug(request()->get('kategori'))]);

    	return [
    		'kategori' => 'required|unique:kategoris,kategori'.(($this->id != null) ? ','.$this->id : ''),
    		'slug' => 'required|unique:kategoris,slug'.(($this->id != null) ? ','.$this->id : ''),
    	];
    }
}
