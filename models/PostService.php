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
        $c = new Post;
        $c->id = PostService::$counter++;
        $c->title = $title;
        $c->text = $text;
        $c->author = $author;
        $c-> date = date('d-m-Y H:i:s',time());

        static::$posts[] = $c;
    }

    public function getAllPosts()
    {
        return static::$posts;
    }

    public function deletePost($id)
    {
        foreach (static::$posts as $post) {
            if ($post->id == $id)
            {
                unset(static::$posts[$post->id]);
            }

        }
        return $this->getAllPosts();
    }
    public function addPost(Post $post)
    {
        static::$posts[] = $post;
    }
}