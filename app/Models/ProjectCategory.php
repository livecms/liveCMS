<?php

namespace App\Models;

use App\liveCMS\Models\BaseModel;
use App\liveCMS\Models\Traits\AdminModelTrait;

class ProjectCategory extends BaseModel
{
    use AdminModelTrait;

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
