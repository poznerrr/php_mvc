<?php

namespace views;

class PostView
{
    public function __construct($postStatus)
    {
        switch ($postStatus) {
            case 'new':
                ob_start();
                require dirname(__DIR__) . '/layouts/post.phtml';
                ob_end_flush();
                break;
            case 'success':
                ob_start();
                require dirname(__DIR__) . '/layouts/postSuccess.html';
                ob_end_flush();
                break;
        }
    }
}