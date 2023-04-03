<?php
declare(strict_types=1);

namespace Source\Controllers;

abstract class Controller
{
    abstract public function render(): void;
} 