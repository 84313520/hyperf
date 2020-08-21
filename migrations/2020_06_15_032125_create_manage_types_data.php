<?php

use App\Model\ManageType;
use Hyperf\Database\Migrations\Migration;

class CreateManageTypesData extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        ManageType::create([
            'id' => 1,
            'name' => '量贩',
        ]);

        ManageType::create([
            'id' => 2,
            'name' => '夜总会',
        ]);

        ManageType::create([
            'id' => 3,
            'name' => '酒吧',
        ]);

        ManageType::create([
            'id' => 4,
            'name' => '混合',
        ]);

        ManageType::create([
            'id' => 5,
            'name' => '养生',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
}
