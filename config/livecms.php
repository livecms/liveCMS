<?php

return [
    'domain' => env('APP_DOMAIN', 'livecms.dev'),

    'slugs' => [
        'admin'         => '@',
        'article'       => 'a',
        'staticpage'    => 'p',
        'team'          => 't',
        'project'       => 'x',
        'client'        => 'c',
    ],

    'themes' => [
        'admin' => 'adminLTE',
        'front' => 'timer',
    ],
];
