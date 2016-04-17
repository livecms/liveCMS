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
        return $user->is_author || $user->is_admin;
    }

    public function allowsUserCreate($user)
    {
        return $user->is_author || $user->is_administer;
    }

    public function allowsUserUpdate($user)
    {
        return $this->author_id && $this->author_id == $user->id || $user->is_administer;
    }

    public function allowsUserDelete($user)
    {
        return $this->author_id && $this->author_id == $user->id;
    }
}
