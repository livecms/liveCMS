<?php

namespace App\Models;

use App\liveCMS\Models\BaseModel;
use App\liveCMS\Models\Traits\AuthorModelTrait;

class Tag extends BaseModel
{
    use AuthorModelTrait;

    protected $useAuthorization = false;
    
    protected $fillable = ['tag', 'slug'];

    public function rules()
    {
        $this->slugify('tag');

        return [
            'tag' => $this->uniqify('tag'),
            'slug' => $this->uniqify('slug'),
        ];
    }
}
