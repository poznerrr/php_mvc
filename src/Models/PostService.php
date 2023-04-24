<?php

declare(strict_types=1);

namespace Source\Models;

use Source\App\Registry;

class PostService
{
    use TSingletone;


    private \PDO $db;

    protected function __construct()
    {
        $this->db = Registry::get('dbObject');
    }

    public function createPost(string $title, string $text, int $userId, int $categoryId): void
    {
        $query = "INSERT INTO posts VALUES (NULL, ?,?,?,?,?)";
        $statement = $this->db->prepare($query);
        $statement->execute([$title, $text, $userId, $categoryId, time()]);
    }


    public function getAllPosts(): array
    {
        $posts = [];
        $query = "SELECT posts.post_id, posts.title, posts.post_text, posts.post_date, 
            categories.category_name, users.user_name
            FROM posts, categories, users
            WHERE posts.category_id = categories.category_id AND posts.user_id = users.user_id";
        $result = $this->db->query($query);
        while ($row = $result->fetch()) {
            $post = new Post;
            $post->setId($row['post_id']);
            $post->setCategory($row['category_name']);
            $post->setTitle($row['title']);
            $post->setText($row['post_text']);
            $post->setAuthor($row['user_name']);
            $post->setDate(date('Y-m-d H:i:s', $row['post_date']));

            $posts[] = $post;
        }
        return $posts;
    }

    public function deletePost(string $id): bool
    {
        $query = "DELETE FROM posts WHERE post_id=?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id]);
    }

    public function getPostsBetween(int $firstNews, int $newsOffset): array
    {
        $posts = [];
        $query = "SELECT posts.post_id, posts.title, posts.post_text, posts.post_date, 
            categories.category_name, users.user_name
            FROM posts, categories, users
            WHERE posts.category_id = categories.category_id AND posts.user_id = users.user_id
            ORDER BY post_id DESC
            LIMIT $firstNews, $newsOffset";
        $result = $this->db->query($query);
        while ($row = $result->fetch()) {
            $post = new Post;
            $post->setId($row['post_id']);
            $post->setCategory($row['category_name']);
            $post->setTitle($row['title']);
            $post->setText($row['post_text']);
            $post->setAuthor($row['user_name']);
            $post->setDate(date('Y-m-d H:i:s', $row['post_date']));

            $posts[] = $post;
        }
        return $posts;
    }

    public function getPostsCount(): int {
        $sql = "SELECT COUNT(*) FROM posts";
        $res = $this->db->query($sql);
        return $res->fetchColumn();
    }

}