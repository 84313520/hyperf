<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CoreMiddleware extends \Hyperf\HttpServer\CoreMiddleware
{
    /**
     * @param ServerRequestInterface $request
     * @return array|\Hyperf\Utils\Contracts\Arrayable|mixed|ResponseInterface|string
     */
    protected function handleNotFound(ServerRequestInterface $request)
    {
        return jsonError(404,'not found',404);
    }

    /**
     * @param array $methods
     * @param ServerRequestInterface $request
     * @return array|\Hyperf\Utils\Contracts\Arrayable|mixed|ResponseInterface|string
     */
    protected function handleMethodNotAllowed(array $methods, ServerRequestInterface $request)
    {
        return jsonError(405,$methods.' not allowed',405);
    }

}