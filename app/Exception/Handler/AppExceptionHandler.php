<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace App\Exception\Handler;

use App\Common\RequestLog;
use Throwable;
use Psr\Http\Message\ResponseInterface;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\ExceptionHandler\ExceptionHandler;

class AppExceptionHandler extends ExceptionHandler
{
    /**
     * @var StdoutLoggerInterface
     */
    protected $logger;

    public function __construct(StdoutLoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        var_dump($throwable->getTraceAsString());
        $code = $throwable->getCode();
        if (!$code) {
            $code = 1;
        }
        $message = sprintf('%s[%s] in %s', $throwable->getMessage(), $throwable->getLine(), $throwable->getFile());
        RequestLog::error($message);
        RequestLog::error($throwable->getTraceAsString());
        return jsonError($code,$throwable->getMessage(),500);
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
