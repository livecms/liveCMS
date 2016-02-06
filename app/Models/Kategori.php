<?php

namespace App\Models;

class Kategori extends BaseModel
{
    protected $fillable = ['kategori', 'slug'];

    public function rules()
    {
        $slug = str_slug(request()->has('slug') ? request()->get('slug') : request()->get('kategori'));

        request()->merge(compact('slug'));

        return [
            'kategori' => 'required|unique:kategoris,kategori'.(($this->id != null) ? ','.$this->id : ''),
            'slug' => 'required|unique:kategoris,slug'.(($this->id != null) ? ','.$this->id : ''),
        ];
    }
}
