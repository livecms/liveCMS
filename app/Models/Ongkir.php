<?php

namespace App\Models;

use App\liveCommerce\Models\LiveCommerceBaseModel as BaseModel;

class Ongkir extends BaseModel
{
    protected $fillable = ['kurir_id', 'tipe', 'origin', 'destination', 'weight', 'ongkir'];

    protected $dependencies = ['kurir'];

    public function rules()
    {
        return [
            'tipe' => 'required',
            'origin' => 'required',
            'destination' => 'required',
            'weight' => 'required',
            'ongkir' => 'required',
        ];
    }

    public function kurir()
    {
        return $this->belongsTo(Kurir::class);
    }
}
