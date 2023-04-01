<?php

declare(strict_types=1);

namespace Source\App;

class Registry
{
    private static array $storage = array();

    public static function set($key, $value)
    {
        return self::$storage[$key] = $value;
    }

    public static function get($key, $default = null)
    {
        return self::$storage[$key] ?? $default;
    }

    public static function remove($key): bool
    {
        unset(self::$storage[$key]);
        return true;
    }

    public static function clean():bool
    {
        self::$storage = array();
        return true;
    }
}