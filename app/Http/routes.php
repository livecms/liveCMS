<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

liveCMSRouter($router, function ($router, $adminSlug, $subDomain, $subFolder) {



    // your routes before this line =============
    // Frontend, keep it at bottom
    frontendRoute($router);
});
