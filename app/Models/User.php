<?php

namespace App\Models;

use Auth;
use Gate;
use App\Policies\UserPolicy;
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

    public static function boot()
    {
        if (auth()->check()) {
            
            Gate::policy(static::class, UserPolicy::class);

            Gate::authorize('read', app(static::class));

            static::creating(function ($model) {
                Gate::authorize('create', $model);
            });

            static::updating(function ($model) {
                Gate::authorize('update', $model);
            });

            static::deleting(function ($model) {
                Gate::authorize('delete', $model);
            });
        }
    }
}
