<?php

declare(strict_types=1);

namespace controllers;

use views\NotFoundView;

class NotFoundController
{
    public function __construct()
    {
    }

    public function render(): void
    {
        new NotFoundView;
    }
}