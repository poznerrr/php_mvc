<?php

namespace models;

trait TSingletone
{
    protected function __construct(){}

    private static $instance = null;

    private function __clone(){}

    public static function getInstance()
    {
        return static::$instance ??static::$instance = new static();
    }
}