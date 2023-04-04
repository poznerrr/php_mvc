<?php

declare(strict_types=1);

namespace Source\Controllers;

use Source\App\Registry;
use Source\Views\NotFoundView;

class NotFoundController extends Controller
{
    public function __construct()
    {
    }

    public function render(): void
    {
        $view = (new NotFoundView(Registry::get('domainConfig')))->build();
        $this->showOnMonitor($view);
    }
}