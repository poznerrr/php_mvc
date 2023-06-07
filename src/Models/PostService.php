<?php

declare(strict_types=1);

namespace Source\Models;

use Source\App\Registry;
use Source\Interfaces\IInstanceble;

class PostService implements IInstanceble
{
    use TSingletone;


    private \PDO $db;

    protected function __construct()
    {
        $this->db = Registry::get('dbObject');
    }

    public function createPost(string $title, string $text, int $userId, int $categoryId): bool
    {
        try {
            $query = "INSERT INTO posts VALUES (NULL, ?,?,?,?,?)";
            $statement = $this->db->prepare($query);
            return $statement->execute([$title, $text, $userId, $categoryId, time()]);
        } catch (\Throwable) {
            return false;
        }
    }


    public function getAllPosts(): array
    {
        $posts = [];
        $query = "SELECT posts.post_id, posts.title, posts.post_text, posts.post_date, 
            categories.category_name, categories.category_id, users.user_name, users.user_id
            FROM posts, categories, users
            WHERE posts.category_id = categories.category_id AND posts.user_id = users.user_id";
        $result = $this->db->query($query);
        while ($row = $result->fetch()) {
            $post = new Post;
            $post->setId($row['post_id']);
            $post->setCategory(new Category ($row['category_id'], $row['category_name']));
            $post->setTitle($row['title']);
            $post->setText($row['post_text']);
            $post->setAuthor(new User($row['user_id'], $row['user_name']));
            $post->setDate(date('Y-m-d H:i:s', $row['post_date']));

            $posts[] = $post;
        }
        return $posts;
    }

    public function deletePost(int $id): bool
    {
        $query = "DELETE FROM posts WHERE post_id=?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id]);
    }

    public function getPostsBetween(int $firstNews, int $newsOffset): array
    {
        $posts = [];
        $query = "SELECT posts.post_id, posts.title, posts.post_text, posts.post_date, 
            categories.category_name, categories.category_id, users.user_name, users.user_id
            FROM posts, categories, users
            WHERE posts.category_id = categories.category_id AND posts.user_id = users.user_id
            ORDER BY post_id DESC
            LIMIT $firstNews, $newsOffset";
        $result = $this->db->query($query);
        while ($row = $result->fetch()) {
            $post = new Post;
            $post->setId($row['post_id']);
            $post->setCategory(new Category ($row['category_id'], $row['category_name']));
            $post->setTitle($row['title']);
            $post->setText($row['post_text']);
            $post->setAuthor(new User($row['user_id'], $row['user_name']));
            $post->setDate(date('Y-m-d H:i:s', $row['post_date']));

            $posts[] = $post;
        }
        return $posts;
    }

    public function getPostsCount(): int
    {
        $sql = "SELECT COUNT(*) FROM posts";
        $res = $this->db->query($sql);
        return $res->fetchColumn();
    }

    public function getPostsCountWithSearch(string $searchCombination): int
    {
        $sql = "SELECT COUNT(*) FROM posts 
                WHERE MATCH (title, post_text)
                    AGAINST ('$searchCombination' IN NATURAL LANGUAGE MODE)";
        $res = $this->db->query($sql);
        return $res->fetchColumn();
    }


    public function updatePost(string $title, string $text, int $userId, int $categoryId, int $postId): bool
    {
        $query = "UPDATE posts SET title = ?, post_text = ?, user_id = ?, category_id = ?, post_date = ? WHERE post_id = ?";
        $stmt = $this->db->prepare($query);
        try {
            return $stmt->execute([$title, $text, $userId, $categoryId, time(), $postId]);
        } catch (\Throwable) {
            return false;
        }
    }

    public function getPostById(int $id): ?Post
    {
        try {
            $query = "SELECT posts.post_id, posts.title, posts.post_text, posts.post_date,
            categories.category_name, categories.category_id, users.user_name, users.user_id
            FROM posts
            JOIN categories ON posts.category_id = categories.category_id
            JOIN users ON  posts.user_id = users.user_id
            WHERE posts.post_id = $id";
            $result = $this->db->query($query);
            $row = $result->fetch();
            $post = new Post;
            $post->setId($row['post_id']);
            $post->setCategory(new Category ($row['category_id'], $row['category_name']));
            $post->setTitle($row['title']);
            $post->setText($row['post_text']);
            $post->setAuthor(new User($row['user_id'], $row['user_name']));
            $post->setDate(date('Y-m-d H:i:s', $row['post_date']));
            return $post;
        } catch (\Throwable) {
            return null;
        }
    }

    public function getFindPostsBetween(int $firstNews, int $newsOffset, string $search): array
    {
        $posts = [];
        $query = "SELECT posts.post_id, posts.title, posts.post_text, posts.post_date, 
            categories.category_name, categories.category_id, users.user_name, users.user_id
            FROM posts
                JOIN categories ON posts.category_id = categories.category_id
                JOIN users ON posts.user_id = users.user_id
            WHERE MATCH (title, post_text)
                AGAINST ('$search' IN NATURAL LANGUAGE MODE)
            LIMIT $firstNews, $newsOffset";
        $result = $this->db->query($query);
        while ($row = $result->fetch()) {
            $post = new Post;
            $post->setId($row['post_id']);
            $post->setCategory(new Category ($row['category_id'], $row['category_name']));
            $post->setTitle($row['title']);
            $post->setText($row['post_text']);
            $post->setAuthor(new User($row['user_id'], $row['user_name']));
            $post->setDate(date('Y-m-d H:i:s', $row['post_date']));

            $posts[] = $post;
        }
        return $posts;
    }

    public function getTopSimilarPosts(int $currentId, string $search): array
    {
        $posts = [];
        $query = "SELECT posts.post_id, posts.title, posts.post_text, posts.post_date, 
            categories.category_name, categories.category_id, users.user_name, users.user_id
            FROM posts
                JOIN categories ON posts.category_id = categories.category_id
                JOIN users ON posts.user_id = users.user_id
            WHERE MATCH (title, post_text)
                AGAINST ('$search' IN NATURAL LANGUAGE MODE) AND posts.post_id != $currentId
            LIMIT 5";
        $result = $this->db->query($query);
        while ($row = $result->fetch()) {
            $post = new Post;
            $post->setId($row['post_id']);
            $post->setCategory(new Category ($row['category_id'], $row['category_name']));
            $post->setTitle($row['title']);
            $post->setText($row['post_text']);
            $post->setAuthor(new User($row['user_id'], $row['user_name']));
            $post->setDate(date('Y-m-d H:i:s', $row['post_date']));

            $posts[] = $post;
        }
        return $posts;
    }

}