<?php

declare(strict_types=1);

namespace models;

trait TSingletone
{
    protected function __construct()
    {
    }

    private static mixed $instance = null;

    private function __clone(): void
    {
    }

    public static function getInstance()
    {
        return static::$instance ?? static::$instance = new static();
    }
}