<?php

namespace App\Models;

class Kelurahan extends BaseModel
{
    const TIPE_DESA = 'Desa';
    const TIPE_KELURAHAN = 'Kelurahan';

    public $defTipe = [self::TIPE_DESA => self::TIPE_DESA, self::TIPE_KELURAHAN => self::TIPE_KELURAHAN];

    protected $fillable = ['kelurahan', 'tipe', 'kecamatan_id'];

    protected $dependencies = ['kecamatan'];

    public function rules()
    {
        return [
            'kelurahan' => 'required',
            'tipe' => 'required',
        ];
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
}
