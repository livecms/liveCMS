<?php

namespace App\liveCMS\Models;

use Auth;
use Gate;
use App\liveCMS\Policies\UserPolicy;
use App\liveCMS\Models\Traits\UserModelTrait;
use App\liveCMS\Models\Contracts\UserModelInterface as UserModelContract;

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

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        
        static::setPolicy(UserPolicy::class);
    }
}
