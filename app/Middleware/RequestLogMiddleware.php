<?php

declare(strict_types=1);

namespace App\Middleware;

use Hyperf\Utils\Arr;
use Hyperf\Utils\Context;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RequestLogMiddleware implements MiddlewareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var ServerRequestInterface
     */
    protected $request;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->request = $request;
        $requestId = $request->getHeaderLine('X_REQUEST_ID');
        if (! $requestId) {
            $requestId = $this->createSerializeId();
        }
        $request = $request->withAttribute('request_id', $requestId);
        $request = $request->withAttribute('request_start_time', microtime(true));
        Context::set(ServerRequestInterface::class, $request);
        $response =  $handler->handle($request);
        Context::set(ResponseInterface::class, $response);
        return $response;
    }

    /**
     * 创建唯一标识
     * @param string $prefix 请求标识前缀
     * @return string 请求标识
     * @author wujiecheng@star-net.cn
     * @since 2020年06月15日 下午16:59:15
     */
    public function createSerializeId($prefix = null)
    {
        $serverParams = $this->request->getServerParams();
//        $this->request->get
        $uuid = Arr::get($serverParams, 'REMOTE_ADDR', '');
        $uuid.= Arr::get($serverParams, 'REMOTE_PORT', '');
        $uuid.= Arr::get($serverParams, 'HTTP_USER_AGENT', '');
        $uuid.= Arr::get($serverParams, 'REQUEST_TIME_FLOAT', '');
        return hash('ripemd128', uniqid('', true) . md5($prefix . $uuid));
    }
}
