<?php

namespace App\Models;

class Kelurahan extends BaseModel
{
    protected $fillable = ['kelurahan', 'tipe', 'kecamatan_id'];

    protected $dependencies = [];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
}
