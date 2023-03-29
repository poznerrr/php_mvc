<?php

declare(strict_types=1);

namespace models;

class PostService
{
    use TSingletone;


    private $db;

    protected function __construct()
    {
        global $dbObject;
        $this->db = $dbObject;
    }

    public function createPost(string $title, string $text, string $author): void
    {
        $query = "INSERT INTO posts VALUES (NULL, ?,?,?,?)";
        $statement = $this->db->prepare($query);
        $statement->execute(array($title, $text, $author, time()));
    }

    public function getAllPosts(): array
    {
        $posts = array();
        $query = "SELECT * from posts";
        $result = $this->db->query($query);
        while ($row = $result->fetch()) {
            $post = new Post;
            $post->setId($row['postId']);
            $post->setTitle($row['postTitle']);
            $post->setText($row['postText']);
            $post->setAuthor($row['postAuthor']);
            $post->setDate(date('Y-m-d H:i:s', $row['postDate']));

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