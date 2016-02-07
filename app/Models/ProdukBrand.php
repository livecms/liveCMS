<?php

namespace App\Models;

class ProdukBrand extends BseModel
{
    protected $fillable = ['brand', 'slug'];

    protected $dependencies = [];

    public function rules()
    {
        $slug = str_slug(request()->has('slug') ? request()->get('slug') : request()->get('brand'));

        request()->merge(compact('slug'));

        return [
            'brand' => 'required|unique:'.$this->getTable().',brand'.(($this->id != null) ? ','.$this->id : ''),
            'slug' => 'required|unique:'.$this->getTable().',slug'.(($this->id != null) ? ','.$this->id : ''),
        ];
    }

    public function produks()
    {
        return $this->hasMany(Produk::class);
    }
}
