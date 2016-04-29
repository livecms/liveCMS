<?php

namespace App\liveCMS\Models;

use Auth;
use Gate;
use Validator;
use App\liveCMS\Policies\UserPolicy;
use App\liveCMS\Models\Traits\UserModelTrait;
use App\liveCMS\Models\Contracts\UserModelInterface as UserModelContract;

class User extends BaseModel implements UserModelContract
{
    use UserModelTrait;

    protected $allSites = true;

    protected $withSuper = false;

    protected static $picturePath = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'avatar', 'background', 'jobtitle', 'socials', 'about', 'site_id',
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

    protected $casts = ['socials' => 'array'];   

    protected $credentials = ['username', 'email', 'password'];

    public function rules()
    {
        $request = request();

        if ($request->isMethod('delete')) {

            return [
                'password' => $this->validPrivilege('password'),
            ];
        }

        if ($request->has('credentials')) {

            if ($request->has('unban') || $request->has('admin_yes') || $request->has('admin_no')) {

                return [
                    'password' => $this->validPrivilege('password'),
                ];
            }

            $password = bcrypt($request->get('newpassword'));
            $request->merge(compact('password'));

            return [
                'newpassword' => 'required|confirmed|min:6',
                'passwordprivilege' => $this->validPrivilege('passwordprivilege'),
            ];
        }

        return [
            'name' => 'required',
            // 'username' => $this->uniqify('username', 'required|max:255'),
            'email' => $this->uniqify('email', 'required|email|max:255'),
            'password' => 'required|confirmed|min:6',
        ];
    }

    protected $excepts = ['socials', 'about', 'background', 'jobtitle', 'site_id'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        
        static::setPolicy(UserPolicy::class);
    }

    public function createUser(array $attributes = [])
    {
        return static::create($attributes);
    }

    public static function create(array $attributes = [])
    {
        $user = parent::create($attributes);
        $credentials = array_only($attributes, $user->credentials);
        
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
