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

    public function deleteCategoryById(int $id): bool
    {
        $sql = "DELETE FROM categories WHERE category_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function createCategory(string $name): bool
    {
        $sql = "INSERT INTO categories VALUES (NULL, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name]);
    }

    public function updateCategoryById(int $id, string $name): bool
    {
        $sql = "UPDATE categories SET category_name = ? WHERE category_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name, $id]);
    }
}
