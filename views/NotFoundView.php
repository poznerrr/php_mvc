<?php

namespace views;

class NotFoundView
{
    public function __construct()
    {
        require dirname(__DIR__) . '/layouts/404.html';
    }
}