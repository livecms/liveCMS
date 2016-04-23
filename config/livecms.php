<?php

return [
    'domain' => env('APP_DOMAIN', 'livecms.dev'),

    'slugs' => [
        'admin'         => '@',
        'article'       => 'a',
        'category'      => 'cat',
        'tag'           => 'tag',
        'staticpage'    => 'p',
        'team'          => 't',
        'project'       => 'x',
        'projectcategory'   => 'x-cat',
        'client'        => 'c',
        'gallery'       => 'g',
        'contact'       => 'contact',
        'userhome'      => 'me',
        'profile'       => 'profile',
    ],

    'users' => [
        'defaultpassword' => 'passwordlivecms',
    ],

    'themes' => [
        'admin' => 'adminLTE',
        'front' => 'timer',
    ],
];
