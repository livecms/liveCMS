<?php

namespace App\liveCMS\Collective\Html;

use App\liveCMS\Illuminate\Routing\UrlGenerator;
use Collective\Html\HtmlBuilder;
use Illuminate\Contracts\View\Factory;

class FormBuilder
{
    public function __construct(HtmlBuilder $html, UrlGenerator $url, Factory $view, $csrfToken)
    {
        parent::__construct($html, $url, $view, $csrfToken);
    }
}
