<?php

namespace App\liveCMS\Models\Traits;

use ImageMax;
use Illuminate\Support\Str;

trait ImagableTrait
{
    protected $imageAttributes = ['picture'];

    protected function getImagableAttributes()
    {
        return property_exists($this, 'images') ? (array) $this->images : $this->imageAttributes;
    }

    public function toArray()
    {
        $array = parent::toArray();

        return $this->getImagesArray($array);
    }

    public function getAttribute($key)
    {
        $attribute = parent::getAttribute($key);
        
        if (!$attribute) {

            $profiles = config('imagemax.profiles', []);
            
            foreach ($profiles as $profile => $options) {
            
                if (Str::endsWith($key, $last = '_'.str_slug($profile, '_')))
                {
                    $image = Str::replaceLast($last, '', $key);

                    if (in_array($image, $this->getImagableAttributes()) && $this->getAttribute($image)) {

                        return ImageMax::make($this->getAttribute($image), $options);
                    }
                }
            }
        }

        return $attribute;
    }

    protected function getImagesArray($attributes)
    {
        $images = $this->getImagableAttributes();

        $profiles = config('imagemax.profiles', []);

        foreach ($images as $image) {

            foreach ($profiles as $profile => $options) {
                
                if (isset($attributes[$image])) {

                    $attributes[str_slug($image.'_'.$profile, '_')] = ImageMax::make($attributes[$image], $options);
                }
            }
        }

        return $attributes;
    }
}