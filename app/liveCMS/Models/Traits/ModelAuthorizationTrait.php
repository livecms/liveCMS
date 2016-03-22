<?php

namespace App\liveCMS\Models\Traits;

use Auth;
use Gate;
use App\liveCMS\Policies\ModelPolicy;
use Illuminate\Auth\Access\AuthorizationException;

trait ModelAuthorizationTrait
{
    public static function bootModelAuthorizationTrait()
    {
        if (auth()->check()) {
            
            Gate::policy(static::class, ModelPolicy::class);

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
