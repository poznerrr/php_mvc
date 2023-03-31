<?php

namespace models;

use app\Registry;

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
        $query = "SELECT UserId, UserName
            FROM users";
        $result = $this->db->query($query);
        while ($row = $result->fetch()) {
            $user = new User();
            $user->setId($row['UserId']);
            $user->setName($row['UserName']);

            $users[] = $user;
        }
        return $users;
    }
}