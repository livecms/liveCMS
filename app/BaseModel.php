<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model implements BaseModelInterface
{
    use BaseModelTrait;

    protected $dependencies = [];

    protected $rules = [];

    protected $aliases = [];

    protected $addition = [];

    protected $deletion = [];
}
