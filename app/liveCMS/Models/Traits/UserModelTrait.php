<?php

namespace App\liveCMS\Models\Traits;

use App\liveCMS\Models\Site;
use App\liveCMS\Models\Users\Role;

trait UserModelTrait
{
    public function getInitial()
    {
        $name = strtoupper($this->name);

        $words = count($names = explode(' ', $name));

        $inits = array_map(function ($value) {
            return substr($value, 0, 1);
        }, $names);

        $initials = $inits[0]. ($words > 1 ?  last($inits) : '');

        return $initials;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function getSiteRootUrl()
    {
        return $this->site ? $this->site->getRootUrl() : site()->getRootUrl();
    }

    public function getIsSuperAttribute()
    {
        return $this->roles->where('role', 'super')->count() > 0;
    }

    public function getIsAdminAttribute()
    {
        return $this->roles->where('role', 'admin')->count() > 0;
    }

    public function getIsAdministerAttribute()
    {
        $roles = ['super', 'admin'];

        return $this->roles->filter(function ($item) use ($roles) {
            return in_array(data_get($item, 'role'), $roles);
        })->count() > 0;
    }

    public function getIsBannedAttribute()
    {
        return $this->roles->where('role', 'banned')->count() > 0;
    }

    public function allowsUserRead($user)
    {
        return $user->is_admin;
    }
}
