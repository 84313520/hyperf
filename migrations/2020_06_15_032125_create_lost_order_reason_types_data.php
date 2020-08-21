<?php

use App\Model\LostOrderReasonType;
use Hyperf\Database\Migrations\Migration;

class CreateLostOrderReasonTypesData extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        LostOrderReasonType::create([
            'id' => 1,
            'name' => '价格太高',
        ]);

        LostOrderReasonType::create([
            'id' => 2,
            'name' => '功能不满足',
        ]);

        LostOrderReasonType::create([
            'id' => 3,
            'name' => '客户关系不到位',
        ]);

        LostOrderReasonType::create([
            'id' => 4,
            'name' => '其他',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
}
