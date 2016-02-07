<?php

namespace App\Models;

class Kurir extends BaseModel
{
    protected $fillable = ['kode', 'kurir', 'logo', 'alamat', 'nama_kontak', 'no_kontak', 'catatan'];

    protected $dependencies = [];

    public function ongkirs()
    {
        return $this->hasMany(Ongkir::class);
    }
}
