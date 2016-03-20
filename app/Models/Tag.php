<?php

namespace App\Models;

use App\liveCMS\Models\BaseModel;

class Tag extends BaseModel
{
    protected $fillable = ['tag', 'slug'];

    public function rules()
    {
        $slug = str_slug(request()->has('slug') ? request()->get('slug') : request()->get('tag'));

        request()->merge(compact('slug'));

        return [
            'tag' => 'required|unique:'.$this->getTable().',tag'.(($this->id != null) ? ','.$this->id : ''),
            'slug' => 'required|unique:'.$this->getTable().',slug'.(($this->id != null) ? ','.$this->id : ''),
        ];
    }
}
