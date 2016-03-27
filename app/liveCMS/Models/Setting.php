<?php

namespace App\liveCMS\Models;

use Cache;

class Setting extends BaseModel
{
    protected $fillable = ['key', 'value', 'site_id'];

    public function rules()
    {
        $site_id = site()->id;

        request()->merge(compact('site_id'));

        return [
            'key' => 'required|unique:'.$this->getTable().',key,'.((string) $this->id).',id,site_id,'.$site_id,
            'value' => 'required'
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            $model->process();
        });

        static::deleted(function ($model) {
            $model->process();
        });
    }

    protected function process()
    {
        Cache::forget('global_params');

        $global_params = static::get();

        Cache::forever('global_params', $global_params);
    }
}
