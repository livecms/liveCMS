<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukTag extends Model
{
    protected $fillable = ['tag', 'slug'];

    protected $dependencies = [];

    public function rules()
    {
        $slug = str_slug(request()->has('slug') ? request()->get('slug') : request()->get('tag'));

        request()->merge(compact('slug'));

        return [
            'tag' => 'required|unique:'.$this->getTable().',tag'.(($this->id != null) ? ','.$this->id : ''),
            'slug' => 'required|unique:'.$this->getTable().',slug'.(($this->id != null) ? ','.$this->id : ''),
        ];
    }

    public function produks()
    {
        return $this->hasMany(Produk::class);
    }
}
