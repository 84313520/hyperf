<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2020/4/2
 * Time: 01:11
 * 公共辅助方法类
 */
use Hyperf\Utils\Context;
use Hyperf\Logger\LoggerFactory;
use Hyperf\Utils\ApplicationContext;
use Hyperf\Contract\StdoutLoggerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

/**
 * json成功输出
 * @param array $data
 * @param string $message
 * @param array $headers
 * @return PsrResponseInterface
 */
function jsonSuccess($data = [], $message = 'success', $headers = [])
{
    if (isset($data['errorcode'])) {
        $responseData = $data;
    } else {
        $responseData = [
            'errorcode' => 0,
            'errormessage' => $message,
            'data' => $data
        ];
    }

//    $response = new \Hyperf\HttpServer\Response(\Hyperf\Utils\Context::get(PsrResponseInterface::class));
    $response = Context::get(PsrResponseInterface::class);
    $response = $response
        ->withStatus(200)
        ->withHeader('content-type', 'application/json; charset=utf-8');
    if (is_array($headers) && $headers) {
        foreach ($headers as $name => $value) {
            $response = $response->withHeader($name, $value);
        }
    }
    $responseData = \Hyperf\Utils\Codec\Json::encode($responseData);
    $response = $response->withBody(new \Hyperf\HttpMessage\Stream\SwooleStream($responseData));
    Context::set(PsrResponseInterface::class, $response);
    \App\Common\RequestLog::logResponse($response);
    return $response;
//    return $response->json($responseData)->withStatus(200);
}

/**
 * json失败输出
 * @param $code
 * @param string $message
 * @param int $statusCode
 * @param array $headers
 * @return PsrResponseInterface
 */
function jsonError($code, $message = '', $statusCode = 400, $headers = [])
{
    $responseData = [
        'errorcode' => $code,
        'errormessage' => $message,
    ];
//    $response = new \Hyperf\HttpServer\Response(\Hyperf\Utils\Context::get(PsrResponseInterface::class));

    $response = Context::get(PsrResponseInterface::class);
    $response = $response
        ->withStatus($statusCode)
        ->withHeader('content-type', 'application/json; charset=utf-8');
    if (is_array($headers) && $headers) {
        foreach ($headers as $name => $value) {
            $response = $response->withHeader($name, $value);
        }
    }
    $responseData = \Hyperf\Utils\Codec\Json::encode($responseData);
    $response = $response->withBody(new \Hyperf\HttpMessage\Stream\SwooleStream($responseData));
    Context::set(PsrResponseInterface::class, $response);
    \App\Common\RequestLog::logResponse($response);
    return $response;
}

function getRequestId()
{
    $request = Context::get(ServerRequestInterface::class);
    return $request->getAttribute('request_id', '');
}


/**
 * 获取Container
 */
if (! function_exists('app')) {
    /**
     * Finds an entry of the container by its identifier and returns it.
     * @param null|mixed $id
     * @return mixed|\Psr\Container\ContainerInterface
     */
    function app($id = null)
    {
        $container = ApplicationContext::getContainer();
        if ($id) {
            return $container->get($id);
        }
        return $container;
    }
}

/**
 * 控制台日志
 */
if (! function_exists('stdLog')) {
    function stdLog()
    {
        return app()->get(StdoutLoggerInterface::class);
    }
}

/**
 * 文件日志
 */
if (! function_exists('logger')) {
    function logger($name = 'hyperf', $group = 'default')
    {
        return app()->get(LoggerFactory::class)->get($name, $group);
    }
}

/**
 * redis 客户端实例
 */
if (! function_exists('redis')) {
    function redis()
    {
        return app()->get(Hyperf\Redis\Redis::class);
    }
}
