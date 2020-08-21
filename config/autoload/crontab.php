<?php

declare(strict_types=1);

use Hyperf\Crontab\Crontab;

/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

return [
    'enable' => env('CRONTAB_ENABLE', true),
    'crontab' => [
        (new Crontab())->setType('command')->setName('syncDianpingShops')->setRule('*/30 * * * *')->setCallback([
            'command' => 'sync:dianpingShops',
        ]),
        (new Crontab())->setType('command')->setName('findManagementIntegrationCompanies')->setRule('00 03 * * *')->setCallback([
            'command' => 'data:findManagementIntegrationCompanies',
        ]),
        (new Crontab())->setType('command')->setName('findIntegrationCompanies')->setRule('15 03 * * *')->setCallback([
            'command' => 'data:findIntegrationCompanies',
        ]),
    ],
];
