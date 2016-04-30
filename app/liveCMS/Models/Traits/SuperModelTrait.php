<?php

namespace App\liveCMS\Models\Traits;

trait SuperModelTrait
{
    public function allowsUserAccess($user)
    {
        return true;
    }

    public function allowsUserRead($user)
    {
        return $user->is_super;
    }

    public function allowsUserCreate($user)
    {
        return $user->is_super;
    }

    public function allowsUserUpdate($user)
    {
        return $user->is_super;
    }

    public function allowsUserDelete($user)
    {
        return $user->is_super;
    }
}
