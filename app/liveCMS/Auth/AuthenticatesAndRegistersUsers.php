<?php

namespace App\liveCMS\Auth;

use App\liveCMS\Auth\AuthenticatesUsers as AuthenticatesUsersTrait;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers as OriginalTrait;

trait AuthenticatesAndRegistersUsers
{
    // use AuthenticatesUsers, RegistersUsers {
    //     AuthenticatesUsers::redirectPath insteadof RegistersUsers;
    //     AuthenticatesUsers::getGuard insteadof RegistersUsers;
    // }
    
    use AuthenticatesUsersTrait, OriginalTrait;
}
