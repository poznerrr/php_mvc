<?php

declare(strict_types=1);

namespace app;

class Registry
{
    private static array $_storage = array();

    public static function set($key, $value)
    {
        return self::$_storage[$key] = $value;
    }

    public static function get($key, $default = null)
    {
        return (isset(self::$_storage[$key])) ? self::$_storage[$key] : $default;
    }

    public static function remove($key): bool
    {
        unset(self::$_storage[$key]);
        return true;
    }

    public static function clean():bool
    {
        self::$_storage = array();
        return true;
    }
}