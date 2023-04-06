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

    public function render(): void
    {
        $view = (new NotFoundView(Registry::get('domain')))->build();
        $this->showOnMonitor($view);
    }
}