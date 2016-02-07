<?php

namespace App\Models;

class Kurir extends BaseModel
{
    protected $fillable = ['kode', 'kurir', 'logo', 'alamat', 'nama_kontak', 'no_kontak', 'catatan'];

    protected $dependencies = [];

    public function rules()
    {
        return [
            'kode' => 'required|unique:'.$this->getTable().',kode'.(($this->id != null) ? ','.$this->id : ''),
            'kurir' => 'required|unique:'.$this->getTable().',kurir'.(($this->id != null) ? ','.$this->id : ''),
            'logo' => 'required',
        ];
    }
}
