<?php

namespace App\liveCMS\Models;

class Profile extends User
{
    protected $table = 'users';

    protected $withSuper = true;

    protected $useAuthorization = false;

    protected $dependencies = [];

    protected $socialMedias = ['github', 'linkedin', 'facebook', 'twitter', 'instagram', 'google-plus'];

    protected $casts = [
        'socials' => 'array',
    ];

    public function allowsUserRead($user)
    {
        return true;
    }

    public function socialMedias()
    {
        return $this->socialMedias;
    }

    public function getSocials($social = null)
    {
        $socials = $this->socials;

        if (count($socials)) {
            
            if ($social === null) {
                return $socials;
            }

            foreach ($socials as $key => $value) {
                if ($social == $key) {

                    return $value;
                }
            }
        }

        return null;
    }

    public function rules()
    {
        $request = request();

        if ($request->has('credentials')) {

            $password = bcrypt($request->get('newpassword'));
            $request->merge(compact('password'));

            return [
                'newpassword' => 'required|confirmed|min:6',
                'passwordprivilege' => $this->validPrivilege('passwordprivilege'),
            ];
        }

        if ($request->has('avatars')) {

            return [
                'picture' => 'image|max:5120',
                'background' => 'image|max:5120',
            ];
        }

        return [
            'name' => 'required',
            'username' => $this->uniqify('username', 'required|max:255'),
            'email' => $this->uniqify('email', 'required|email|max:255'),
            'jobtitle' => 'max:255',
            'socials.*' => 'active_url',
        ];
    }
}
