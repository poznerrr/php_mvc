<?php

declare(strict_types=1);

namespace Source\Models;

use Source\App\Registry;

class CategoryService
{
    use TSingletone;

    private \PDO $db;

    protected function __construct()
    {
        $this->db = Registry::get('dbObject');
    }

    public function getAllCategories(): array
    {
        $categories = [];
        $query = "SELECT category_id, category_name
            FROM categories";
        $result = $this->db->query($query);
        while ($row = $result->fetch()) {
            $category = new Category;
            $category->setId($row['category_id']);
            $category->setName($row['category_name']);

            $categories[] = $category;
        }
        return $categories;
    }
}
