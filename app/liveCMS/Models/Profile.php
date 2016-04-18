<?php

namespace App\liveCMS\Models;

class Profile extends User
{
    protected $table = 'users';

    protected $dependencies = [];

    protected $socialMedias = ['github', 'linkedin', 'facebook', 'twitter', 'instagram', 'google-plus'];

    protected $casts = [
        'socials' => 'array',
    ];

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
        return [
            'name' => 'required',
            'username' => $this->uniqify('username', 'required|max:255'),
            'email' => $this->uniqify('email', 'required|email|max:255'),
            'password' => 'confirmed|min:6',
            'passwordprivilege' => $this->validPrivilege('passwordprivilege'),
            'socials.*' => 'active_url',
        ];
    }
}
