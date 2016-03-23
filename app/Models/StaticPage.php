<?php

namespace App\Models;

use App\liveCMS\Models\PostableModel;

class StaticPage extends PostableModel
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
     
        $this->prefixSlug = globalParams('slug_staticpage', config('livecms.slugs.staticpage'));
    }
}
