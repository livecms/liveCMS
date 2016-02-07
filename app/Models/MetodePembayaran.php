<?php

namespace App\Models;

class MetodePembayaran extends BaseModel
{
    protected $fillable = ['tipe', 'nama_bank', 'no_rekening', 'nama_rekening', 'logo'];

    protected $dependencies = [];
}
