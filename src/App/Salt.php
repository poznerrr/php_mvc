<?php

declare(strict_types=1);

namespace Source\App;

class Salt
{
    public static function generateSalt(): string
    {
        $salt = '';
        $saltLength = 8;
        for ($i = 0; $i < $saltLength; $i++) {
            $salt .= chr(mt_rand(33, 126)); //символ из ASCII-table
        }
        return $salt;
    }


}