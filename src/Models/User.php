<?php

declare(strict_types=1);

namespace Source\Models;

class User
{
    private int $id;
    private string $name;

    public function __construct(int|null $id = null, string|null $name = null)
    {
        if (isset($id)) {
            $this->id = $id;
        }
        if (isset($name)) {
            $this->name = $name;
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}