<?php
declare(strict_types=1);

namespace Source\App;


class Request
{
    public array $params;
    public array $apiBody = [];

    public function __construct($uriParams)
    {
        $rawBody = file_get_contents('php://input');
        if ($rawBody) {
            try {
                $this->apiBody = json_decode($rawBody, true);
            } catch (\Throwable $e) {

            }
        }
        $this->params = array_merge($uriParams, $_REQUEST, $_SERVER, $this->apiBody);
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