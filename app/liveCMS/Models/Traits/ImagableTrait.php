<?php

namespace App\liveCMS\Models\Traits;

use ImageMax;

trait ImagableTrait
{
    protected $imageAttributes = ['picture'];

    protected function getImageAttributes()
    {
        return property_exists($this, 'images') ? (array) $this->images : $imageAttributes;
    }

    public function toArray()
    {
        $array = array_merge(parent::toArray(), $this->getImagesArray());

        return $array;
    }

    public function getAttribute($key)
    {
        $array = $this->getImagesArray();

        if (array_key_exists($key, $array)) {
            return $array[$key];
        }
        
        $get = parent::getAttribute($key);
        
        if ($get != null) {
            return $get;
        }

        return null;
    }

    protected function getImagesArray()
    {
        $images = $this->getImageAttributes();

        $profiles = config('imagemax.profiles', []);

        $array = [];

        foreach ($images as $image) {
            
            foreach ($profiles as $profile => $options) {
                
                $array[str_slug($image.'_'.$profile)] = ($url = $this->getAttribute($image)) ? ImageMax::make($url, $options) : null;
            }
        }
    }
}
