<?php

namespace App\Models;

use App\liveCMS\Models\BaseModel;
use App\liveCMS\Models\Setting;
use App\liveCMS\Models\Traits\AdminModelTrait;

class Contact extends BaseModel
{
    use AdminModelTrait;

    protected $fillable = ['address', 'address2', 'city', 'country', 'postcode', 'telephone', 'faximile', 'email'];

    public function rules()
    {
        return [
            'postcode' => 'numeric',
            'email' => 'email',
        ];
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
     
        $default = Setting::privateOnly()->pluck('value', 'key')->toArray();

        $attributes = array_replace($default, $attributes);

        $this->fill($attributes);
    }

    /**
     * Save a new model and return the instance.
     *
     * @param  array  $attributes
     * @return static
     */
    public static function create(array $attributes = [])
    {
        $site_id = site()->id;

        $contact = new static;

        $fillable = $contact->getFillable();

        foreach (array_only($attributes, $fillable) as $key => $value) {

            $row = Setting::privateOnly()->firstOrNew(compact('key', 'site_id'));
            $row->fill(compact('value'));
            $row->save();
        }

        return true;
    }
}
