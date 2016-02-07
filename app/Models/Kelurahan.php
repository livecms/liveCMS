<?php

namespace App\Models;

class Kelurahan extends BaseModel
{
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
