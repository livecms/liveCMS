<?php

namespace App\liveCMS\Controllers\Auth;

use Illuminate\Http\Request;
use App\liveCMS\Controllers\Controller;
use App\liveCMS\Models\Users\User;
use App\liveCMS\Models\User as UserModel;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);

        $userSlug = globalParams('slug_userhome', config('livecms.slugs.userhome'));
        $this->redirectTo = '/'.$userSlug;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, app(UserModel::class)->rules());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return UserModel::createUser($data);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        $credentials = $request->only($this->loginUsername(), 'password');
        
        return array_merge($credentials, ['site_id' => site()->getCurrent()->id]);
    }

    protected function authenticated($request, User $user)
    {
        if ($user->is_banned) {
            $this->logout();
            alert()->error(trans('backend.userisbanned'), trans('backend.loginfailed'));
            return redirect()->back();
        }
        
        if ($user->site_id != site()->getCurrent()->id) {
            $this->logout();

            $url = $user->site->getRootUrl().$this->redirectTo;


            return redirect()->away($url);
        }

        return redirect()->intended($this->redirectTo);
    }
}
