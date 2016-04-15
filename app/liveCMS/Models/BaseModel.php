<?php

namespace App\liveCMS\Models;

use Illuminate\Database\Eloquent\Model;
use App\liveCMS\Models\Traits\BaseModelTrait;
use App\liveCMS\Models\Traits\ModelAuthorizationTrait;
use App\liveCMS\Models\Contracts\BaseModelInterface as BaseModelContract;
use App\liveCMS\Models\Contracts\ModelAuthorizationInterface as ModelAuthorizationContract;
use App\liveCMS\Policies\AdminPolicy;

abstract class BaseModel extends Model implements BaseModelContract, ModelAuthorizationContract
{
    use BaseModelTrait, ModelAuthorizationTrait;

    protected $hidden = ['site_id'];

    protected $dependencies = [];

    protected $rules = [];

    protected $aliases = [];

    protected $addition = [];

    protected $deletion = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        
        static::setPolicy(AdminPolicy::class);
    }
}
