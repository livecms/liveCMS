<?php

namespace App\liveCMS\Models\Traits;

trait AdminModelTrait
{
    public function allowsUserAccess($user)
    {
        return true;
    }

    public function allowsUserRead($user)
    {
        return true;
    }

    public function allowsUserCreate($user)
    {
        return $user->is_administer;
    }

    public function allowsUserUpdate($user)
    {
        return $user->is_administer;
    }

    public function allowsUserDelete($user)
    {
        return $this->author_id && $this->author_id == $user->id;
    }
}
