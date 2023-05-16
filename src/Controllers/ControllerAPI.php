<?php
declare(strict_types=1);

namespace Source\Controllers;

use Source\Interfaces\Idto;

abstract class ControllerAPI
{
    public function returnAnswer(Idto $dto): void
    {
        echo $dto->toJson();
    }
}