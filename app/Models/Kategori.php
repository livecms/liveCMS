<?php

namespace App\Models;

use App\liveCMS\Models\BaseModel;

class Kategori extends BaseModel
{
    protected $fillable = ['kategori', 'slug'];

    public function rules()
    {
        $slug = str_slug(request()->has('slug') ? request()->get('slug') : request()->get('kategori'));

        request()->merge(compact('slug'));

        return [
            'kategori' => 'required|unique:'.$this->getTable().',kategori'.(($this->id != null) ? ','.$this->id : ''),
            'slug' => 'required|unique:'.$this->getTable().',slug'.(($this->id != null) ? ','.$this->id : ''),
        ];
    }
}
