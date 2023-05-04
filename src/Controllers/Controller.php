<?php

declare(strict_types=1);

namespace Source\Controllers;

use Source\App\Request;

abstract class Controller
{
    abstract public function renderDefault(Request $req): void;

    protected function showOnMonitor(string $view): void
    {
        echo $view;
    }

} 