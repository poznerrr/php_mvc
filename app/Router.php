<?php

declare(strict_types=1);

namespace app;

use controllers\{NotFoundController, IndexController, PostController};

class Router
{

    public function __construct()
    {
    }

    public function route(string $url): void
    {
        switch ($url) {
            case '/':
                if (isset($_POST['delete']) && isset($_POST['id'])) {
                    (new IndexController)->delete();
                } else {
                    (new IndexController)->render();
                }
                break;
            case '/post':
                (new PostController)->render();
                break;
            default:
                (new NotFoundController)->render();
                break;
        }
    }


}