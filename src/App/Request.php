<?php
declare(strict_types=1);

namespace Source\App;


class Request
{
    public array $params;

    public function __construct($uriParams)
    {
        $this->params = array_merge($uriParams, $_REQUEST);
    }

    public function getParam(string $paramName): ?string
    {
        if (isset($this->params[$paramName])) {
            return $this->params[$paramName];
    }
        return null;
    }

    public function getIntParam(string $paramName): ?int
    {
        if (isset($this->params[$paramName])) {
            return (int)$this->params[$paramName];
    }
        return null;
    }
}