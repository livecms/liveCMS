<?php

namespace App\Models;

use App\liveCMS\Models\BaseModel;

class Category extends BaseModel
{
    protected $fillable = ['category', 'slug'];

    public function rules()
    {
        $this->slugify('category');

        return [
            'category' => $this->uniqify('category'),
            'slug' => $this->uniqify('slug'),
        ];
    }
}
