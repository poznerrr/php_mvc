<?php

declare(strict_types=1);

namespace Source\Controllers;

use Source\App\Request;

abstract class ControllerHTTP
{
  // public abstract function get(Request $req, ...$services): void;


    protected function showOnMonitor(string $view): void
    {
        echo $view;
    }

} 