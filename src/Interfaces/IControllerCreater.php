<?php
declare(strict_types=1);

namespace Source\Interfaces;

use Source\Controllers\Controller;
interface IControllerCreater
{
    public static function createController(): Controller;
}
