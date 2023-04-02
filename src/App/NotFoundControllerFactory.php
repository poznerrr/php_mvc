<?php
declare(strict_types=1);

namespace Source\App;

use Source\Interfaces\IControllerCreater;
use Source\Controllers\{Controller, NotFoundController};

class NotFoundControllerFactory implements IControllerCreater
{
public static function createController(): Controller
{
    return new NotFoundController();
}
}