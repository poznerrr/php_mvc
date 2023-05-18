<?php
declare(strict_types=1);

namespace Source\Controllers;

use Source\App\{JwtHandler, Request};
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
    private PostService $postService;


    public function __construct()
    {
        $this->postService = PostService::getInstance();
    }

    public function get(Request $req): void
    {
        $incomeDto = new GettingByIdDto($req);
        if (!$incomeDto->isValid) {
            $outcomeDto = new ErrorDto('Bad parameters');
        } else {
            list($isAuthorized, $authorizedMessage) = JwtHandler::checkJwt($incomeDto->authorizeString);
            if (!$isAuthorized) {
                $outcomeDto = new ErrorDto($authorizedMessage);
            } else {
                $this->post = $this->postService->getPostById($incomeDto->id);
                if ($this->post) {
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
            }
        }
        $this->returnAnswer($outcomeDto);
    }

    public function delete(Request $req): void
    {
        $incomeDto = new GettingByIdDto($req);
        if (!$incomeDto->isValid) {
            $outcomeDto = new ErrorDto('Bad parameters');
        } else {
            list($isAuthorized, $authorizedMessage) = JwtHandler::checkJwt($incomeDto->authorizeString);
            if (!$isAuthorized) {
                $outcomeDto = new ErrorDto($authorizedMessage);
            } else {
                $success = $this->postService->deletePost($incomeDto->id);
                if ($success) {
                    $outcomeDto = new SuccessDto("Deleted successful");
                } else {
                    $outcomeDto = new ErrorDto("News with this id don't match");
                }
            }
        }
        $this->returnAnswer($outcomeDto);
    }

    public function post(Request $req): void
    {
        $incomeDto = new PostCreatorDto($req);
        if (!$incomeDto->isValid) {
            $outcomeDto = new ErrorDto('Bad parameters');
        } else {
            $authorizedString = $incomeDto->authorizeString;
            list($isAuthorized, $authorizedMessage, $userId) = JwtHandler::checkJwt($authorizedString);
            if (!$isAuthorized) {
                $outcomeDto = new ErrorDto($authorizedMessage);
            } else {
                $isCreated = $this->postService->createPost($incomeDto->title, $incomeDto->post, $userId, $incomeDto->categoryId);
                $outcomeDto = $isCreated ? new SuccessDto('Created successfully') : new ErrorDto('Unsuccessfully');
            }
        }
        $this->returnAnswer($outcomeDto);
    }

    public function put(Request $req): void
    {
        $incomeDto = new PostChangerDto($req);
        if (!$incomeDto->isValid) {
            $outcomeDto = new ErrorDto('Bad parameters');
        } else {
            $authorizedString = $incomeDto->authorizeString;
            list($isAuthorized, $authorizedMessage, $userId) = JwtHandler::checkJwt($authorizedString);
            if (!$isAuthorized) {
                $outcomeDto = new ErrorDto($authorizedMessage);
            } else {
                $isChanged = $this->postService->updatePost(
                    $incomeDto->title,
                    $incomeDto->post,
                    $userId,
                    $incomeDto->categoryId,
                    $incomeDto->postId
                );
                $outcomeDto = $isChanged ? new SuccessDto('Changed successfully') : new ErrorDto('Unsuccessfully');
            }
        }
        $this->returnAnswer($outcomeDto);
    }
}