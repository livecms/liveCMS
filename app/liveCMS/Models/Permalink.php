<?php

namespace App\liveCMS\Models;

use App\liveCMS\Models\Traits\AdminModelTrait;

class Permalink extends BaseModel
{
    use AdminModelTrait;

    protected $fillable = ['permalink', 'postable_type', 'postable_id'];

    protected $dependencies = ['postable.children'];

    protected $appends = ['type'];

    public function rules()
    {
        $uri = explode('/', request()->get('permalink'));
        $uri = array_splice($uri, 0, 5);
        $permalink = implode('/', array_map('str_slug', $uri));

        request()->merge(compact('permalink'));

        return [
            'permalink' => 'required|unique:'.$this->getTable().',permalink'.(($this->id != null) ? ','.$this->id : ''),
        ];
    }

    public function postable()
    {
        return $this->morphTo();
    }

    public function getTypeAttribute()
    {
        return basename(str_replace('\\', '/', $this->postable_type));
    }
}
