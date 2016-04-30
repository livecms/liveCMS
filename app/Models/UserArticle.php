<?php

namespace App\Models;

class UserArticle extends Article
{
    protected $table = 'articles';

    public function allowsUserRead($user)
    {
        return true;
    }
}
