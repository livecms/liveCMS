<?php

namespace App;

class Tag extends BaseModel
{
    protected $fillable = ['tag', 'slug'];

    protected $rules = [
    	'tag' => 'required',
    ];
}
