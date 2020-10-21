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

use App\Model\User;
use Hyperf\DbConnection\Db;

class TestController extends AbstractController
{
    public function index()
    {

        $res = User::query()->where('id', 1)->first();

        return $res;
    }

    public function test($a)
    {
        return $a;
    }
}
