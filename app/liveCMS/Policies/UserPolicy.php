<?php

namespace App\liveCMS\Policies;

use App\liveCMS\Models\BaseModel as Model;
use App\liveCMS\Models\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy extends ModelPolicy
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
        return $user->is_super;
    }
}
