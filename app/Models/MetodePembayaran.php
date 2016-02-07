<?php

namespace App\Models;

class MetodePembayaran extends BaseModel
{
    protected $fillable = ['tipe', 'nama_bank', 'no_rekening', 'nama_rekening', 'logo'];

    protected $dependencies = [];

    public function rules()
    {
        return [
            'tipe' => 'required',
            'nama_bank' => 'required',
            'no_rekening' => 'required',
            'nama_rekening' => 'required',
        ];
    }
}
