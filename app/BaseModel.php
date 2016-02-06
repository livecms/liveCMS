<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\liveCMS\Models\BaseModelInterface;
use App\liveCMS\Models\BaseModelTrait;

class BaseModel extends Model implements BaseModelInterface
{
    use BaseModelTrait;

    protected $dependencies = [];

    protected $rules = [];

    protected $aliases = [];

    protected $addition = [];

    protected $deletion = [];
}
