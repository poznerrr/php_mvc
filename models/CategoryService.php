<?php

declare(strict_types=1);

namespace models;

class CategoryService
{
    use TSingletone;

    private \PDO $db;

    protected function __construct()
    {
        global $dbObject;
        $this->db = $dbObject;
    }

    public function getAllCategories(): array
    {
        $categories = array();
        $query = "SELECT CategoryId, CategoryName
            FROM categories";
        $result = $this->db->query($query);
        while ($row = $result->fetch()) {
            $category = new Category;
            $category->setId($row['CategoryId']);
            $category->setName($row['CategoryName']);

            $categories[] = $category;
        }
        return $categories;
    }
}
