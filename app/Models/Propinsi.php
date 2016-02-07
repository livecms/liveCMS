<?php

namespace App\Models;

class Propinsi extends BaseModel
{
    protected $fillable = ['propinsi'];

    protected $dependencies = ['kota'];

    public function rules()
    {
        return [
            'propinsi' => 'required|unique:'.$this->getTable().',propinsi'.(($this->id != null) ? ','.$this->id : ''),
        ];
    }

    public function kotas()
    {
        return $this->hasMany(Kota::class);
    }
}
