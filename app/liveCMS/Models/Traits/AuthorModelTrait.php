<?php

namespace App\liveCMS\Models\Traits;

trait AuthorModelTrait
{
    public function allowsUserAccess($user)
    {
        return true;
    }

    public function allowsUserRead($user)
    {
        return $user->is_author;
    }

    public function allowsUserCreate($user)
    {
        return $user->is_author;
    }

    public function allowsUserUpdate($user)
    {
        return $user->is_author;
    }

    public function allowsUserDelete($user)
    {
        return $this->author_id && $this->author_id == $user->id;
    }
}
