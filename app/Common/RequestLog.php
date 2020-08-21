<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2020/6/15
 * Time: 17:09
 */

namespace App\Common;

use Hyperf\Utils\Context;
use Hyperf\Logger\LoggerFactory;
use Hyperf\Utils\ApplicationContext;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 *
 * @method static debug($message,$context = [])
 * @method static info($message,$context = [])
 * @method static notice($message,$context = [])
 * @method static warning($message,$context = [])
 * @method static alert($message,$context = [])
 * @method static error($message,$context = [])
 * @method static emergency($message,$context = [])
 * @method static critical($message,$context = [])
 * @method static log($level,$message,$context = [])
 * Class RequestLog
 * @package App\Common
 */
class RequestLog
{
    /**
     * @return \Psr\Log\LoggerInterface
     */
    protected static function getLogger()
    {
        $container = ApplicationContext::getContainer();
        $loggerFactory = new LoggerFactory($container);
        return $loggerFactory->get('log', 'default');
    }

    protected static function getRequest()
    {
        return Context::get(ServerRequestInterface::class);
    }

    public static function __callStatic($name, $arguments)
    {
        $contextArgIndex = 1;
        if ($name == 'log') {
            $contextArgIndex = 2;
        }
        $arguments[$contextArgIndex]['request_id'] = getRequestId();
        if (! isset($arguments[$contextArgIndex]['stage'])) {
            $arguments[$contextArgIndex]['stage'] = 'during_request';
        }
        return call_user_func_array([self::getLogger(),$name], $arguments);
    }

    public static function logResponse(ResponseInterface $response)
    {
        $request = Context::get(ServerRequestInterface::class);

        $requestStartTime = $request->getAttribute('request_start_time', null);
        if ($requestStartTime) {
            $phpRuntime = microtime(true) - $requestStartTime;
        } else {
            $phpRuntime = 0;
        }

        $headers = $request->getHeaders();
        RequestLog::info('request', [
            'request_data' => [
                'headers' => $headers,
                'query_params' => $request->getQueryParams(),
                'body_params' => $request->getParsedBody(),
                'request_uri' => (string) $request->getUri(),
                'method' => $request->getMethod(),
                'server' => $request->getServerParams(),
                'stage' => 'request_start'
            ],
            'response_data' => [
                'headers' => $response->getHeaders(),
                'content' => $response->getBody()->getContents(),
                'php_runtime' => $phpRuntime,
                'stage' => 'request_end',
            ]
        ]);
    }
}
