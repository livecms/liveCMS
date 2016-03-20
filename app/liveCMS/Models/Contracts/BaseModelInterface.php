<?php

namespace App\liveCMS\Models\Contracts;

interface BaseModelInterface
{
    public function dependencies();

    public function rules();

    public function getFields();
}
