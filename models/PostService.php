<?php

declare(strict_types=1);

namespace models;

class PostService
{
    use TSingletone;

    public static int $counter = 0;

    private static array $posts;

    protected function __construct()
    {
    }

    public function createPost(string $title, string $text, string $author): void
    {
        $post = new Post;
        $post->setId(PostService::$counter++);
        $post->setTitle($title);
        $post->setText($text);
        $post->setAuthor($author);
        $post->setDate(date('d-m-Y H:i:s', time()));

        static::$posts[] = $post;
    }

    public function getAllPosts(): array
    {
        return static::$posts;
    }

    public function deletePost(int $id): array
    {
        foreach (static::$posts as $post) {
            if ($post->getId() == $id) {
                unset(static::$posts[$post->getId()]);
            }
        }
        return $this->getAllPosts();
    }

    public function addPost(Post $post): void
    {
        static::$posts[] = $post;
    }
}