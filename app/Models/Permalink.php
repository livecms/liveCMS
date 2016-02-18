<?php

namespace App\Models;

class Permalink extends BaseModel
{
    protected $fillable = ['permalink'];

    public function postable()
    {
        return $this->morphTo();
    }
}
