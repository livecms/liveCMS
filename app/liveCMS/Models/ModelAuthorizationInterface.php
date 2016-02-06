<?php

namespace App\liveCMS\Models;

interface ModelAuthorizationInterface
{
    public function authorize($method);
}
