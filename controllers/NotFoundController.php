<?php

namespace controllers;

use views\NotFoundView;

class NotFoundController
{
    public function __construct()
    {
    }

    public function render()
    {
        new NotFoundView;
    }
}