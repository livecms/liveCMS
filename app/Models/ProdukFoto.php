<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukFoto extends Model
{
    protected $fillable = ['foto', 'keterangan', 'produk_id'];

    protected $dependencies = [];

    public function rules()
    {
        return [
            'foto' => 'required|unique:'.$this->getTable().',foto'.(($this->id != null) ? ','.$this->id : ''),
        ];
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
