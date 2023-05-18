<?php
declare(strict_types=1);

namespace Source\Interfaces;

interface IAnswerDto
{
    public function toJson(): string;

}