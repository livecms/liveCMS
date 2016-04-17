<?php

namespace App\liveCMS\Models;

class Profile extends User
{
    protected $table = 'users';

    protected $dependencies = [];

    public function rules()
    {
        return [
            'name' => 'required',
            'username' => $this->uniqify('username', 'required|max:255'),
            'email' => $this->uniqify('email', 'required|email|max:255'),
            'password' => 'confirmed|min:6',
            'passwordprivilege' => $this->validPrivilege('passwordprivilege'),
        ];
    }
}
