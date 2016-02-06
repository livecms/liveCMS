<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\liveCMS\Models\BaseModelTrait;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use App\liveCMS\Models\BaseModelInterface as BaseModelContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements
    BaseModelContract,
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use BaseModelTrait, Authenticatable, Authorizable, CanResetPassword;

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

    public function getIsBannedAttribute()
    {
        return $this->roles->where('role', 'banned')->count() > 0;
    }

    public function getIsAdminAttribute()
    {
        $roles = ['super', 'admin'];

        return $this->roles->filter(function ($item) use ($roles) {
            return in_array(data_get($item, 'role'), $roles);
        })->count() > 0;
    }
}
