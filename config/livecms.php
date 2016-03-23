<?php

return [
    'domain' => env('APP_DOMAIN', 'livecms.dev'),

    'slugs' => [
        'admin'     => '@',
        'article'   => 'article',
        'staticpage'    => 'staticpage',
    ],

    'themes' => [
        'admin' => 'adminLTE',
        'front' => 'timer',
    ],
];
