<?php

declare(strict_types=1);

namespace Source\Controllers;

use Source\Views\NotFoundView;

class NotFoundController
{
    public function __construct()
    {
    }

    public function render(): void
    {
        (new NotFoundView)->build();
    }
}