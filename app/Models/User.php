<?php

namespace App\Models;

use Auth;
use App\liveCMS\Models\UserModelTrait;
use App\liveCMS\Models\UserModelInterface as UserModelContract;

class User extends BaseModel implements UserModelContract
{
    use UserModelTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $dependencies = ['roles'];

    protected $rules = [];

    protected $aliases = [];

    public function authorize($method = null)
    {
        $user = Auth::user();
        
        if ($user != null && $user->isSuper) {
            return true;
        }

        return false;
    }
}
