<?php
declare(strict_types=1);

namespace Source\Controllers;

use Source\Interfaces\IJsonEncodable;

abstract class ControllerAPI
{
    public function returnAnswer(IJsonEncodable $dto): void
    {
        echo $dto->toJson();
    }
}