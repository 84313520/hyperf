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

namespace App\Controller;

use Hyperf\Di\Annotation\Inject;
use Psr\Container\ContainerInterface;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

abstract class AbstractController
{
    /**
     * @Inject
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @Inject
     * @var RequestInterface
     */
    protected $request;

    /**
     * @Inject
     * @var ResponseInterface
     */
    protected $response;

    protected function jsonSuccess($data = [], $message = 'success', $headers = [])
    {
        return jsonSuccess($data, $message, $headers);
    }


    protected function jsonError($code, $message = '', $statusCode = 400)
    {
        return jsonError($code, $message, $statusCode);
    }

    protected function jsonSuccessForPaginate($paginator, $message = 'success', $headers = [])
    {
        $data = $paginator->items();
        $responseData = [
            'items' => $data,
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'from' => $paginator->firstItem(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'to' => $paginator->lastItem(),
                'total' => $paginator->total(),
            ],
        ];
        return jsonSuccess($responseData, $message, $headers);
    }
}
