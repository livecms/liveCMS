<?php

namespace App;

interface BaseModelInterface
{
    public function dependencies();

    public function rules();

    public function getFields();
}
