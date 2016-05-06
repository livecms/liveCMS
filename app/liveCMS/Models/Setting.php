<?php

namespace App\liveCMS\Models;

use Cache;
use App\liveCMS\Models\Traits\AdminModelTrait;

class Setting extends BaseModel
{
    use AdminModelTrait;

    protected $useAuthorization = false;

    protected $allSites = true;

    protected $fillable = ['key', 'value', 'site_id', 'publicable'];

    protected $hidden = ['publicable', 'site_id'];

    public function rules()
    {
        $site_id = site()->id;
        $publicable = true;

        request()->merge(compact('site_id', 'publicable'));

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

        $global_params = GenericSetting::get();

        Cache::forever('global_params', $global_params);
    }

    public function newQuery()
    {
        $query = parent::newQuery();
        return $query->where('publicable', true);
    }

    public function scopePrivateOnly($query)
    {
        $query = parent::newQuery();
        
        return $query->where('publicable', false);
    }
}
