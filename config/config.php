<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

use Psr\Log\LogLevel;
use Hyperf\Contract\StdoutLoggerInterface;

$stdoutLoglevel = [
    LogLevel::ALERT,
    LogLevel::CRITICAL,
    LogLevel::EMERGENCY,
    LogLevel::ERROR,
    LogLevel::INFO,
    LogLevel::NOTICE,
    LogLevel::WARNING,
];
    // 生产环境使用 prod 值
$env = env('APP_ENV', 'production');
if ($env != 'production') {
    $stdoutLoglevel[] = LogLevel::DEBUG;
}

return [
    // 是否使用注解扫描缓存
    'scan_cacheable' => env('SCAN_CACHEABLE', false),
    'app_name' => env('APP_NAME', 'skeleton'),
    'app_env' => $env,
    StdoutLoggerInterface::class => [
        'log_level' => $stdoutLoglevel,
    ],
];
