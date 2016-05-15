<?php

return [

    'canonical' =>  env('IMAGEMAX_CANONICAL'), // YOUR CANONICAL NAME
    'baseurl' => env('IMAGEMAX_BASEURL'), // YOUR BASE URL
    'profiles' => [
        
        'thumb' => [
            'w' => 128, // width
            'h' => 128, // height
            'q' => 8, // quality
            'fm' => 'jpg', // format
            'bri' => 10, // brightness
        ],
        
        'medium' => '500x300-imxq-8-imxbri-10.jpg', // w = 500; h = 300; q = 8; bri = 10
        
        'large' => '800x600', // w = 800; h = 600
        
        'x-large' => '1200x900', // w = 1200; h = 900
    ],
];
