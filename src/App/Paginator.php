<?php
declare(strict_types=1);

namespace Source\App;

use Source\Models\PostService;

class Paginator
{
    public static function getPages(int $currentPage, int $proposedOffset = 5): array
    {
        $lastPossiblePage = ceil(PostService::getInstance()->getPostsCount() / Registry::get('pageNewsNumber'));
        $firstProposedPage = $currentPage > $proposedOffset ? $currentPage - $proposedOffset : 1;
        $lastProposedPage = $currentPage < $lastPossiblePage - $proposedOffset ? $currentPage + $proposedOffset : $lastPossiblePage;
        return ['first' => $firstProposedPage, 'last' => $lastProposedPage];

    }

}