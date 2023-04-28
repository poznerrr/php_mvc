<?php

declare(strict_types=1);

namespace Source\Models;

class User
{
    private int $id;
    private string $name;
    private string $password;
    private string $salt;

    public function __construct(int|null $id = null, string|null $name = null, string|null $password = null, string|null $salt = null,)
    {
        if (isset($id)) {
            $this->id = $id;
        }
        if (isset($name)) {
            $this->name = $name;
        }
        if (isset($password)) {
            $this->password = $password;
        }
        if (isset($salt)) {
            $this->salt = $salt;
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

    public function getSalt(): string
    {
        return $this->salt;
    }
}