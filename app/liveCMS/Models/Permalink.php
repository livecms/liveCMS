<?php

namespace App\liveCMS\Models;

class Permalink extends BaseModel
{
    protected $fillable = ['permalink', 'postable_type', 'postable_id'];

    protected $dependencies = ['postable'];

    protected $appends = ['type'];

    public function rules()
    {
        $uri = explode(DIRECTORY_SEPARATOR, request()->get('permalink'));
        $uri = array_splice($uri, 0, 5);
        $permalink = implode(DIRECTORY_SEPARATOR, array_map('str_slug', $uri));

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
