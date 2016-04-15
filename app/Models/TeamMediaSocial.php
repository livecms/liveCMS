<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\liveCMS\Models\Traits\AdminModelTrait;

class TeamMediaSocial extends Model
{
    use AdminModelTrait;

    protected $fillable = ['social', 'url'];

    protected $socials = ['facebook', 'twitter', 'google-plus', 'linkedin', 'github'];

    public function socials()
    {
        return $this->socials;
    }
}
