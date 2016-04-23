<?php

namespace App\liveCMS\Models\Users;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const SUPER = 'super';
    const ADMIN = 'admin';
    const AUTHOR = 'author';
    const BANNED = 'banned';
    const REGISTERED = 'registered';

    protected $fillable = ['role'];
}
