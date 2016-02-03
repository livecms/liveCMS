<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $dependencies = [];

    protected $rules = [];
	
    public function newQuery()
    {
        $defaultScope = parent::newQuery();

        return $defaultScope->orderBy($this->getKeyName(), 'DESC');
    }

	public function dependencies()
    {
        return $this->dependencies;
    }

    public function rules()
    {
        return $this->rules;
    }
}
