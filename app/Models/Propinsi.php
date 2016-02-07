<?php

namespace App\Models;

class Propinsi extends BaseModel
{
    protected $fillable = ['propinsi'];

    protected $dependencies = ['kota'];

    public function kotas()
    {
        return $this->hasMany(Kota::class);
    }
}
