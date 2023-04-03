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

    public function __construct(private array $domainConfig, string $postStatus, private array|null $categories, private array|null $users)
    {
        switch ($postStatus) {
            case 'new':
                $this->categories = $categories;
                $this->headerPath = dirname(__DIR__) . '/Layouts/header.phtml';
                $this->templatePath = dirname(__DIR__) . '/Layouts/post.phtml';
                break;
            case 'success':
                $this->headerPath = dirname(__DIR__) . '/Layouts/header.phtml';
                $this->templatePath = dirname(__DIR__) . '/Layouts/postSuccess.phtml';
                break;
        }
    }
}