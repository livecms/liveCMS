<?php

namespace App\Models;

use App\liveCommerce\Models\LiveCommerceBaseModel as BaseModel;

class Pesanan extends BaseModel
{
    protected $fillable = [
            'customer_id',
            'penerima',
            'email',
            'no_hp',
            'alamat',
            'propinsi_id',
            'kota_id',
            'kecamatan_id',
            'kelurahan_id',
            'kodepos',
            'jumlah',
            'diskon',
            'kurir_id',
            'weight',
            'ongkir',
            'metode_pembayaran_id',
            'kode_pesanan',
            'waktu_pesanan',
            'waktu_pengiriman',
            'no_resi_pengiriman',
            'tanggal_diterima',
            'status',
            'catatan',
    ];

    protected $dependencies = ['produks', 'customer', 'propinsi', 'kota', 'kecamatan', 'kelurahan', 'kurir', 'metodePembayaran'];

    public function rules()
    {
        return [
            'penerima' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'propinsi_id' => 'required',
            'kota_id' => 'required',
            'kecamatan_id' => 'required',
            'kelurahan_id' => 'required',
            'kodepos' => 'required',
            'kode_pesanan' => 'required|unique:'.$this->getTable().',kode_pesanan'.(($this->id != null) ? ','.$this->id : ''),
        ];
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    public function produks()
    {
        return $this->belongsToMany(Produk::class, 'pesanan_details')->withPivot('id', 'pesanan_id', 'produk_id', 'produk', 'harga', 'quantity', 'diskon', 'jumlah')->withTimestamps();
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function propinsi()
    {
        return $this->belongsTo(Propinsi::class);
    }
    
    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }

    public function kurir()
    {
        return $this->belongsTo(Kurir::class);
    }

    public function metodePembayaran()
    {
        return $this->belongsTo(MetodePembayaran::class);
    }
}
