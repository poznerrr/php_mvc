<?php

namespace controllers;

class NotFoundController
{
public function __construct()
{
}

public function render() {
    require dirname(__DIR__) . '/views/404.html';
}
}