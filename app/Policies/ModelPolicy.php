<?php

namespace App\Policies;

use App\User;
use App\Models\BaseModel as Model;
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
        return $user->is_admin;
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
