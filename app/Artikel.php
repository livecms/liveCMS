<?php

namespace App;

class Artikel extends BaseModel
{
    protected $fillable = ['judul', 'slug', 'isi'];

    protected $dependencies = ['kategoris', 'tags'];

    public function rules()
    {
        $slug = str_slug(request()->has('slug') ? request()->get('slug') : request()->get('judul'));

        request()->merge(compact('slug'));

        return [
            'judul' => 'required|unique:artikels,judul'.(($this->id != null) ? ','.$this->id : ''),
            'slug' => 'required|unique:artikels,slug'.(($this->id != null) ? ','.$this->id : ''),
            'isi' => 'required',
        ];
    }

    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'artikel_kategoris');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'artikel_tags');
    }
    
}
