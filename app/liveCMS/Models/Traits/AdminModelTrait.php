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
        return $user->is_admin;
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
        return $user->is_administer;
    }
}
