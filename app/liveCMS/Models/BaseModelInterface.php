<?php

namespace App\liveCMS\Models;

interface BaseModelInterface
{
    public function authorize($method);

    public function dependencies();

    public function rules();

    public function getFields();
}
