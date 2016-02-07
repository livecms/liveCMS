<?php

namespace App\Models;

class ProdukBrand extends BseModel
{
    protected $fillable = ['brand', 'slug'];

    protected $dependencies = [];

    public function produks()
    {
        return $this->hasMany(Produk::class);
    }
}
