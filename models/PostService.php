<?php

declare(strict_types=1);

namespace models;

use app\Registry;

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
        $statement->execute(array($title, $text, $userId, $categoryId, time()));
    }


    public function getAllPosts(): array
    {
        $posts = array();
        $query = "SELECT Posts.PostId, Posts.Title, Posts.PostText, Posts.PostDate, 
            Categories.CategoryName, Users.UserName
            FROM posts, categories, users
            WHERE Posts.CategoryId = Categories.CategoryId AND Posts.UserId = Users.UserId";
        $result = $this->db->query($query);
        while ($row = $result->fetch()) {
            $post = new Post;
            $post->setId($row['PostId']);
            $post->setCategory($row['CategoryName']);
            $post->setTitle($row['Title']);
            $post->setText($row['PostText']);
            $post->setAuthor($row['UserName']);
            $post->setDate(date('Y-m-d H:i:s', $row['PostDate']));

            $posts[] = $post;
        }
        return $posts;
    }

    public function deletePost(int $id): array
    {
        $query = "DELETE FROM posts WHERE postId=$id";
        $this->db->query($query);
        return $this->getAllPosts();
    }

}