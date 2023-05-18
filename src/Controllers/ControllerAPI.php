<?php
declare(strict_types=1);

namespace Source\Controllers;

use Source\Interfaces\IAnswerDto;

abstract class ControllerAPI
{
    public function returnAnswer(IAnswerDto $dto): void
    {
        echo $dto->toJson();
    }
}