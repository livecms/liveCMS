<?php

namespace App\Models;

class Customer extends BaseModel
{
    protected $fillable = [
        'user_id',
        'no_hp',
        'alamat',
        'propinsi_id',
        'kota_id',
        'kecamatan_id',
        'kelurahan_id',
        'kodepos',
    ];

    protected $rules = [
        'no_hp' => 'required',
        'alamat' => 'required',
        'propinsi_id' => 'required',
        'kota_id' => 'required',
        'kecamatan_id' => 'required',
        'kelurahan_id' => 'required',
        'kodepos' => 'required',
    ];

    protected $dependencies = ['user', 'propinsi', 'kota', 'kecamatan', 'kelurahan'];

    public function user()
    {
        return $this->belongsTo('user');
    }

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class);
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
}
