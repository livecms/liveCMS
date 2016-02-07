<?php

namespace App\Models;

use App\liveCommerce\Models\LiveCommerceBaseModel as BaseModel;

class Ongkir extends BaseModel
{
    protected $fillable = ['kurir_id', 'tipe', 'origin', 'destination', 'weight', 'ongkir'];

    protected $dependencies = [];

    public function kurir()
    {
        return $this->belongsTo(Kurir::class);
    }
}
