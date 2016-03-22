<?php

namespace App\liveCMS\Auth;

use Illuminate\Http\Request;

trait AuthenticatesUsers
{
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

}
