<?php

namespace App\Models;

class Kecamatan extends BaseModel
{
    protected $fillable = ['kecamatan', 'kota_id'];

    protected $dependencies = ['kota'];

    public function rules()
    {
        return [
            'kecamatan' => 'required',
        ];
    }

    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }

    public function kelurahans()
    {
        return $this->hasMany(Kelurahan::class);
    }
}
