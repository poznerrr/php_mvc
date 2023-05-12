<?php
declare(strict_types=1);

return [
    '/^(\w+)\/(\w+)\/page-(\d+)\/?.*$/' => ['controller', 'action', 'page'],
    '/^(\w+)\/page-(\d+)$/' => ['controller', 'page'],
    '/^(news)\/[\w-]+-r(\d+)$/' => ['controller', 'postId'],
    '/^(\w+)\/(\w+)\/?.*$/' => ['controller', 'action'],
    '/^(\w+)\/(\w+)$/' => ['controller', 'action'],
    '/^(\w+)$/' => ['controller'],
];
