<?php

namespace App\liveCMS\Models;

use Auth;
use Illuminate\Auth\Access\AuthorizationException;

trait ModelAuthorizationTrait
{
    public static function bootModelAuthorizationTrait()
    {
        if (app(static::class)->authorize('read') === false) {
            throw new AuthorizationException('This action is unauthorized.');
        }

        static::creating(function ($model) {
            if ($model->authorize('create') === false) {
                throw new AuthorizationException('This action is unauthorized.');
            }
        });

        static::updating(function ($model) {
            if ($model->authorize('update') === false) {
                throw new AuthorizationException('This action is unauthorized.');
            }
        });

        static::deleting(function ($model) {
            if ($model->authorize('delete') === false) {
                throw new AuthorizationException('This action is unauthorized.');
            }
        });
    }

    public function authorize($method = null)
    {
        $user = Auth::user();
        
        if ($user != null && $user->isBanned) {
            return false;
        }

        if ($user != null && $user->isAdmin) {
            return true;
        }

        return false;
    }
}
