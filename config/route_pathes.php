<?php
declare(strict_types=1);

return [
    '/^(api)\/(\w+)\/(\d+)$/' => ['method', 'controller', 'postId'],
    '/^(api)\/(\w+)$/' => ['method', 'controller'],
    '/^(api)\/(authorization)\/(login)$/' => ['method', 'controller', 'action'],
    '/^(\w+)\/(\w+)\/page-(\d+)\/?.*$/' => ['controller', 'action', 'page'],
    '/^(\w+)\/page-(\d+)$/' => ['controller', 'page'],
    '/^(news)\/(chosen)\/[\w-]+-r(\d+)$/' => ['controller', 'action', 'postId'],
    '/^(\w+)\/(\w+)\/?.*$/' => ['controller', 'action'],
    '/^(\w+)\/(\w+)$/' => ['controller', 'action'],
    '/^(\w+)$/' => ['controller'],
];
