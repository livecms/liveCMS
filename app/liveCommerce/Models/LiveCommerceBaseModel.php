<?php

namespace App\liveCommerce\Models;

use App\Models\BaseModel;

abstract class LiveCommerceBaseModel extends BaseModel
{
    public function toArray()
    {
        $array = array_merge(parent::toArray(), $this->getRupiahArray());

        return $array;
    }

    public function getAttribute($key)
    {
        $get = parent::getAttribute($key);
        
        if ($get != null) {
            return $get;
        }

        $array = $this->getRupiahArray();

        if (array_key_exists($key, $array)) {
            return $array[$key];
        }

        return null;
    }

    public function getRupiahArray()
    {
        $array = [];

        $rupiahs = property_exists($this, 'rupiahs') ? $this->rupiahs : [];

        foreach ($rupiahs as $attribute) {
            $attributeRupiah = $attribute.'_rupiah';

            $array[$attributeRupiah] = 'Rp. '.number_format($this->attributes[$attribute], 0, ',', '.');
        }

        return $array;
    }
}
