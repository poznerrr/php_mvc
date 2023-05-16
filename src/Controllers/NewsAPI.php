<?php
declare(strict_types=1);

namespace Source\Controllers;

use Source\App\{DtoFactory, Request};
use Source\Models\{DTO\ErrorDto, DTO\NewsDto, DTO\SuccessDto, PostService, Post};

class NewsAPI extends ControllerAPI
{
    private ?Post $post;
    private PostService $postService;


    public function __construct()
    {
        $this->postService = PostService::getInstance();
    }

    public function get(Request $req): void
    {
        $postId = $req->getParam('postId');
        $this->post = $this->postService->getPostById($postId);
        if ($this->post) {
            $dto = new NewsDto($this->post->getId(),
                $this->post->getTitle(),
                $this->post->getText(),
                $this->post->getCategory()->getName(),
                $this->post->getAuthor()->getName(),
                $this->post->getDate()
            );
        } else {
            $dto = new ErrorDto('Новости с заданным id не существует');
        }
        $this->returnAnswer($dto);
    }

    public function post(Request $req): void
    {
        $title = $req->getParam('title');
        $post = $req->getParam('post');
        $userId = $req->getIntParam('userId');
        $categoryId = $req->getIntParam('categoryId');
        $isCreate = $this->postService->createPost($title, $post, $userId, $categoryId);
        if ($isCreate) {
            $dto = new SuccessDto('Пост успешно создан');
        } else {
            $dto = new ErrorDto('Нe удалось создать пост');
        }
        $this->returnAnswer($dto);
    }
}