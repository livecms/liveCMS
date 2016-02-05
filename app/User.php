<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements BaseModelInterface
{
    use BaseModelTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dependencies = [];

    protected $rules = [];

    protected $aliases = [];

    public function getInitial()
    {
        $name = strtoupper($this->name);

        $words = count($names = explode(' ', $name));

        $inits = array_map(function($value) {
            return substr($value, 0, 1);
        }, $names);

        $initials = $inits[0]. ($words > 1 ?  last($inits) : '');

        return $initials;
    }
}
