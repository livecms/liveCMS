<?php

namespace App\liveCMS\Models\Traits;

use Gate;
use App\liveCMS\Policies\ModelPolicy;
use Illuminate\Auth\Access\AuthorizationException;

trait ModelAuthorizationTrait
{
    protected static $policy;

    protected static function authorization()
    {
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

    protected static function setPolicy($policy)
    {
        info('set policy '.static::class);
        static::$policy = $policy;
    }

    protected static function bootModelAuthorizationTrait()
    {
        if (static::$policy === null) {
            
            static::setPolicy(ModelPolicy::class);
        }
        
        Gate::policy(static::class, static::$policy);
        
        if (auth()->check()) {
            
            static::authorization();
        }
    }
}
