<?php

declare(strict_types=1);

use App\Exception\Handler\ValidationExceptionHandler;
use App\Exception\Handler\ModelNotFoundExceptionHandler;

/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

return [
    'handler' => [
        'http' => [
            ValidationExceptionHandler::class,
            ModelNotFoundExceptionHandler::class,
            Hyperf\HttpServer\Exception\Handler\HttpExceptionHandler::class,
            App\Exception\Handler\AppExceptionHandler::class,
        ],
    ],
];
