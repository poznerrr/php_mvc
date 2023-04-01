<?php
declare(strict_types=1);

namespace Source\Views;

use Source\App\Lib\Traits\TPageBuilder;

class PostView
{
    use TPageBuilder;

    private string $header;

    private string $headerPath;

    private string $templatePath;

    private array|null $categories;

    private array|null $users;

    public function __construct(string $postStatus, array|null $categories, array|null $users)
    {
        $this->categories = $categories;
        $this->users = $users;

        switch ($postStatus) {
            case 'new':
                $this->categories = $categories;
                $this->headerPath = dirname(__DIR__) . '/Layouts/header.html';
                $this->templatePath = dirname(__DIR__) . '/Layouts/post.phtml';
                break;
            case 'success':
                $this->headerPath = dirname(__DIR__) . '/Layouts/header.html';
                $this->templatePath = dirname(__DIR__) . '/Layouts/postSuccess.phtml';
                break;
        }
    }
}