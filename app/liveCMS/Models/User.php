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

    protected $allSites = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'picture', 'about', 'site_id',
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

    protected $credentials = ['username', 'email', 'password'];

    public function rules()
    {
        return [
            'name' => 'required',
            'username' => $this->uniqify('username', 'required|max:255'),
            'email' => $this->uniqify('email', 'required|max:255'),
            'password' => 'required|confirmed|min:6',
        ];
    }

    protected $aliases = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        
        static::setPolicy(UserPolicy::class);
    }

    public function createUser(array $attributes = [])
    {
        $credentials = array_only($attributes, $this->credentials);

        $user = new static;
        $user->fill($attributes);
        $user->site_id = $user->site_id ? $user->site_id : site()->id;
        $user->save();

        $user->makeCredentials($credentials);

        return $user;
    }

    public function makeCredentials(array $credentials = [])
    {
        $defaultPassword = globalParams('default_password', config('livecms.users.defaultpassword'));

        $email = array_get($credentials, 'email', null);

        if ($email == null) {
            return;
        }

        $username = $this->username ? $this->username : array_get($credentials, 'username', $email);
        
        $password = bcrypt(array_get($credentials, 'password', $defaultPassword));

        $credentials = array_merge($credentials, compact('username', 'password'));

        $this->update($credentials);

        return $this;
    }
}
