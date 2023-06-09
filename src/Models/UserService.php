<?php

declare(strict_types=1);

namespace Source\Models;

use Source\App\Registry;
use Source\Interfaces\IInstanceble;

class UserService implements IInstanceble
{
    use TSingletone;

    private \PDO $db;

    protected function __construct()
    {
        $this->db = Registry::get('dbObject');
    }

    public function getAllUsers(): array
    {
        $users = [];
        $query = "SELECT user_id, user_name
            FROM users";
        $result = $this->db->query($query);
        while ($row = $result->fetch()) {
            $user = new User($row['user_id'], $row['user_name']);
            $users[] = $user;
        }
        return $users;
    }

    public function deleteUserById(int $id): bool
    {
        $sql = "DELETE FROM users WHERE user_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function createUser(string $name, string $pass): bool
    {
        $sql = "INSERT INTO users VALUES (NULL, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name, $pass]);
    }

    public function updateUserById(int $id, string $name): bool
    {
        $sql = "UPDATE users SET user_name = ? WHERE user_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name, $id]);
    }

    public function getUserByName(string $name): User|null
    {
        $sql = "SELECT * FROM users WHERE user_name = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$name]);
        $res = $stmt->fetch();
        if (!empty($res)) {
            return new User($res['user_id'], $res['user_name'], $res['pass']);
        } else {
            return null;
        }
    }

    public function getUserById(string $id): ?User
    {
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $res = $stmt->fetch();
        if (!empty($res)) {
            return new User($res['user_id'], $res['user_name'], $res['pass']);
        } else {
            return null;
        }
    }
}