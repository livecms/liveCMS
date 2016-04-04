<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMediaSocial extends Model
{
    protected $fillable = ['social', 'url'];

    protected $socials = ['facebook', 'twitter', 'google-plus', 'linkedin', 'github'];

    public function socials()
    {
        return $this->socials;
    }
}
