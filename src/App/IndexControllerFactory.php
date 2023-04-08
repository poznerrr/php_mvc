<?php
declare(strict_types=1);

namespace Source\App;

use Source\Interfaces\IControllerCreater;
use Source\Controllers\{Controller, IndexController};

class IndexControllerFactory implements IControllerCreater
{
    public static function createController(): Controller
    {
        return new IndexController();
    }
}