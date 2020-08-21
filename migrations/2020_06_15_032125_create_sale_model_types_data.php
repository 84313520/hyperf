<?php

use App\Model\SaleModelType;
use Hyperf\Database\Migrations\Migration;

class CreateSaleModelTypesData extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        SaleModelType::create([
            'id' => 1,
            'name' => '新场连锁',
        ]);

        SaleModelType::create([
            'id' => 2,
            'name' => '新场非连锁',
        ]);

        SaleModelType::create([
            'id' => 3,
            'name' => '原视易升级设备升级',
        ]);

        SaleModelType::create([
            'id' => 4,
            'name' => '原视易升级重新装修',
        ]);

        SaleModelType::create([
            'id' => 5,
            'name' => '非视易设备改造',
        ]);

        SaleModelType::create([
            'id' => 6,
            'name' => '非视易重新装修',
        ]);

        SaleModelType::create([
            'id' => 7,
            'name' => '非视易连锁场所改造',
        ]);

        SaleModelType::create([
            'id' => 8,
            'name' => '非视易连锁场所重新装修',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
}
