<?php
/**
 * 公共方法类
 * User: penghcheng
 * Date: 2020/5/18
 * Time: 11:29
 */

use Hyperf\Logger\LoggerFactory;
use Hyperf\Utils\ApplicationContext;
use Hyperf\Contract\StdoutLoggerInterface;

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
