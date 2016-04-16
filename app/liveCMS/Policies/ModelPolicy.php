<?php

namespace App\liveCMS\Policies;

use App\liveCMS\Models\Users\User;
use App\liveCMS\Models\Contracts\BaseModelInterface as Model;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModelPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before(User $user)
    {
        // return $user->is_admin;
    }

    public function access(User $user, Model $model)
    {
        return $model->allowsUserAccess($user);
    }

    public function read(User $user, Model $model)
    {
        return $model->allowsUserRead($user);
    }

    public function create(User $user, Model $model)
    {
        return $model->allowsUserCreate($user);
    }

    public function update(User $user, Model $model)
    {
        return $model->allowsUserUpdate($user);
    }

    public function delete(User $user, Model $model)
    {
        return $model->allowsUserDelete($user);
    }
}
