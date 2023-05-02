<?php

declare(strict_types=1);

namespace Source\Models;

class User
{
    private int $id;
    private string $name;
    private string $password;

    public function __construct(int $id, string $name, ?string $password = null)
    {

        $this->id = $id;
        $this->name = $name;
        if ($password !== null) {
            $this->password = $password;
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

    public function getPassword(): string
    {
        return $this->password;
    }

}