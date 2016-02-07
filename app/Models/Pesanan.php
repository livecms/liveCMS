<?php

namespace App\Models;

use App\liveCommerce\Models\LiveCommerceBaseModel as BaseModel;

class Pesanan extends BaseModel
{
    protected $fillable = ['pesanan_id', 'metode_pembayaran_id', 'jumlah', 'bukti', 'verified_at'];

    protected $dependencies = [];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }

    public function metodePembayaran()
    {
        return $this->belongsTo(MetodePembayaran::class);
    }
}
