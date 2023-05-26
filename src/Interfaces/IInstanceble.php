<?php
declare(strict_types=1);

namespace Source\Interfaces;

interface IInstanceble
{
    public static function getInstance() : self;
}