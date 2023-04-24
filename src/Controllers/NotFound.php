<?php

declare(strict_types=1);

namespace Source\Controllers;

use Source\App\Registry;
use Source\Views\NotFoundView;

class NotFound extends Controller
{
    public function __construct()
    {
    }

    public function render(array $uriOptions = null): void
    {
        $view = (new NotFoundView(Registry::get('domain')))->buildHTML();
        $this->showOnMonitor($view);
    }
}