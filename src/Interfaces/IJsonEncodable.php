<?php
declare(strict_types=1);

namespace Source\Interfaces;

interface IJsonEncodable
{
    public function toJson(): string;

}