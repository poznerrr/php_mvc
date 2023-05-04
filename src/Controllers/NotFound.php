<?php

declare(strict_types=1);

namespace Source\Controllers;

use Source\App\{Registry, Request};
use Source\Views\NotFoundView;

class NotFound extends Controller
{
    public function __construct()
    {
    }

    public function renderDefault(Request $req): void
    {
        $view = (new NotFoundView(Registry::get('domain')))->buildHTML();
        $this->showOnMonitor($view);
    }
}