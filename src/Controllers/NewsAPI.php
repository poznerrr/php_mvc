<?php
declare(strict_types=1);

namespace Source\Controllers;

use Source\App\{DtoValidator, JwtHandler, Request};
use Source\Models\{DTO\ErrorDto,
    DTO\GettingByIdDto,
    DTO\NewsDto,
    DTO\PostChangerDto,
    DTO\PostCreatorDto,
    DTO\SuccessDto,
    PostService,
    Post
};

class NewsAPI extends ControllerAPI
{
    private ?Post $post;


    public function __construct()
    {
    }


    public function get(Request $req, PostService $postService): void
    {
        [$isAuthorized, $authorizedMessage] = JwtHandler::checkJwt();
        if (!$isAuthorized) {
            $this->returnAnswer(new ErrorDto($authorizedMessage));
            exit();
        }
        if (!DtoValidator::checkValidation($req, GettingByIdDto::class)) {
            $this->returnAnswer(new ErrorDto('Incorrect data'));
            exit();
        }

        $incomeDto = new GettingByIdDto($req);
        if ($this->post = $postService->getPostById($incomeDto->postId)) {
            $outcomeDto = new NewsDto($this->post->getId(),
                $this->post->getTitle(),
                $this->post->getText(),
                $this->post->getCategory()->getName(),
                $this->post->getAuthor()->getName(),
                $this->post->getDate()
            );
        } else {
            $outcomeDto = new ErrorDto("News with this id don't match");
        }
        $this->returnAnswer($outcomeDto);
    }


    public function delete(Request $req, PostService $postService): void
    {
        [$isAuthorized, $authorizedMessage] = JwtHandler::checkJwt();
        if (!$isAuthorized) {
            $this->returnAnswer(new ErrorDto($authorizedMessage));
            exit();
        }
        if (!DtoValidator::checkValidation($req, GettingByIdDto::class)) {
            $this->returnAnswer(new ErrorDto('Incorrect data'));
            exit();
        }

        $incomeDto = new GettingByIdDto($req);
        if ($postService->deletePost($incomeDto->postId)) {
            $outcomeDto = new SuccessDto("Deleted successful");
        } else {
            $outcomeDto = new ErrorDto("News with this id don't match");
        }
        $this->returnAnswer($outcomeDto);
    }

    public function post(Request $req, PostService $postService): void
    {
        [$isAuthorized, $authorizedMessage, $userId] = JwtHandler::checkJwt();
        if (!$isAuthorized) {
            $this->returnAnswer(new ErrorDto($authorizedMessage));
            exit();
        }
        if (!DtoValidator::checkValidation($req, PostCreatorDto::class)) {
            $this->returnAnswer(new ErrorDto('Incorrect data'));
            exit();
        }

        $incomeDto = new PostCreatorDto($req);
        $isCreated = $postService->createPost($incomeDto->title, $incomeDto->post, $userId, $incomeDto->categoryId);
        $outcomeDto = $isCreated ? new SuccessDto('Created successfully') : new ErrorDto('Unsuccessfully');
        $this->returnAnswer($outcomeDto);
    }

    public function put(Request $req, PostService $postService): void
    {
        [$isAuthorized, $authorizedMessage, $userId] = JwtHandler::checkJwt();
        if (!$isAuthorized) {
            $this->returnAnswer(new ErrorDto($authorizedMessage));
            exit();
        }
        if (!DtoValidator::checkValidation($req, PostChangerDto::class)) {
            $this->returnAnswer(new ErrorDto('Incorrect data'));
            exit();
        }

        $incomeDto = new PostChangerDto($req);
        $this->post = $postService->getPostById($incomeDto->postId);
        if ($this->post === null) {
            $this->returnAnswer(new ErrorDto('Post with current id not found'));
        } else {
            $isChanged = $postService->updatePost(
                $incomeDto->title,
                $incomeDto->post,
                $userId,
                $incomeDto->categoryId,
                $incomeDto->postId
            );
            $outcomeDto = $isChanged ? new SuccessDto('Changed successfully') : new ErrorDto('Unsuccessfully');
            $this->returnAnswer($outcomeDto);
        }
    }
}
