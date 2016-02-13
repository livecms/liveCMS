<?php

namespace App\Models;

class StaticPage extends BaseModel
{
    protected $fillable = ['judul', 'slug', 'isi'];

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
}
