<?php

namespace models;

class PostService
{
    use TSingletone;

    public static $counter = 0;

    private static $posts;

    protected function __construct()
    {
    }

    public function createPost($title, $text, $author)
    {
        $post = new Post;
        $post->setId(PostService::$counter++);
        $post->setTitle($title);
        $post->setText($text);
        $post->setAuthor($author);
        $post->setDate(date('d-m-Y H:i:s', time()));

        static::$posts[] = $post;
    }

    public function getAllPosts()
    {
        return static::$posts;
    }

    public function deletePost($id)
    {
        foreach (static::$posts as $post) {
            if ($post->getId() == $id) {
                unset(static::$posts[$post->getId()]);
            }
        }
        return $this->getAllPosts();
    }

    public function addPost(Post $post)
    {
        static::$posts[] = $post;
    }
}