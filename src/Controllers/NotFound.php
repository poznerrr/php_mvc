<?php

declare(strict_types=1);

namespace Source\Controllers;

use Source\App\{Registry, Request};
use Source\Views\NotFoundView;

class NotFound extends ControllerHTTP
{
    public function __construct()
    {
    }

    public function get(Request $req): void
    {
        $view = (new NotFoundView(Registry::get('domain')))->buildHTML();
        $this->showOnMonitor($view);
    }
}