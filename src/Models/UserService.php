<?php

declare(strict_types=1);

namespace Source\Models;

use Source\App\Registry;

class UserService
{
    use TSingletone;

    private \PDO $db;

    protected function __construct()
    {
        $this->db = Registry::get('dbObject');
    }

    public function getAllUsers(): array
    {
        $users = array();
        $query = "SELECT user_id, user_name
            FROM users";
        $result = $this->db->query($query);
        while ($row = $result->fetch()) {
            $user = new User();
            $user->setId($row['user_id']);
            $user->setName($row['user_name']);

            $users[] = $user;
        }
        return $users;
    }
}