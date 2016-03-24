<?php

return [
    'domain' => env('APP_DOMAIN', 'livecms.dev'),

    'slugs' => [
        'admin'     => '@',
        'article'   => 'a',
        'staticpage'    => 'p',
    ],

    'themes' => [
        'admin' => 'adminLTE',
        'front' => 'timer',
    ],
];
