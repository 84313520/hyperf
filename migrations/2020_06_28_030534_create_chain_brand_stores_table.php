<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateChainBrandStoresTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chain_brand_stores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vod_system')->nullable()->comment('点播系统品牌(VOD 厂商表)');
            $table->string('management_system')->nullable()->comment('管理系统品牌(VOD 厂商表)');
            $table->boolean('is_shiyi')->default(false)->comment('是否是视易：0 不是，1 是');
            $table->string('store_name')->nullable()->comment('门店名称');
            $table->tinyInteger('store_type')->default(0)->comment('门店类型，0: 总店, 1: 分店');
            $table->string('region_code')->nullable()->comment('所在区域');
            $table->string('address')->nullable()->comment('所在地址');
            $table->string('relation_name')->nullable()->comment('负责人');
            $table->string('relation_phone')->nullable()->comment('负责人电话');
            $table->integer('chain_brand_id')->comment('连锁品牌 id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chain_brand_stores');
    }
}
