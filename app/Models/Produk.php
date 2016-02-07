<?php

namespace App\Models;

use App\liveCommerce\Models\LiveCommerceBaseModel as BaseModel;

class Produk extends BaseModel
{
    protected $fillable = ['produk', 'slug', 'produk_kategori_id', 'harga', 'harga_diskon', 'deskripsi', 'netto', 'foto', 'produk_brand_id', 'stock'];

    protected $dependencies = ['produkFotos'];

    public function produkFotos()
    {
        return $this->hasMany(ProdukFoto::class);
    }

    public function produkKategori()
    {
        return $this->belongsTo(ProdukKategori::class);
    }

    public function produkBrand()
    {
        return $this->belongsTo(ProdukBrand::class);
    }
}
