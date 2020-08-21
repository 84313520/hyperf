<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateDianpingShopsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dianping_shops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('shop_id', 64)->index()->comment('点评商户ID');
            $table->string('shop_name', 128)->comment('点评商户名称');
            $table->string('shop_type', 16)->nullable(false)->default('')->comment('类型')->index();
            $table->string('address')->comment('地址');
            $table->string('lat', 20)->nullable(false)->default('')->comment('纬度gcj坐标');
            $table->string('lng', 20)->nullable(false)->default('')->comment('经度 gcj坐标');
            $table->string('standard_prov_code', 16)->nullable(false)->default('')->comment('标准省份编码');
            $table->string('standard_city_code', 16)->nullable(false)->default('')->comment('标准城市编码');
            $table->string('standard_area_code', 16)->nullable(false)->default('')->comment('标准区域编码');
            $table->string('dish_tag')->nullable(false)->default('')->comment('点评标签');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dianping_shops');
    }
}
