<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateIndustryCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('industry_companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('')->comment('场所名');
            $table->string('region_code')->nullable()->comment('区域码');
            $table->string('address')->nullable()->comment('地址');
            $table->integer('manage_type')->nullable()->comment('经营性质');
            $table->string('vod_manufacturer')->nullable()->comment('VOD品牌标识');
            $table->integer('chain_brand_id')->nullable()->comment('连锁品牌标识');
            $table->string('intelligent_control_manufacturer')->nullable()->comment('智控品牌标识');
            $table->string('intelligent_control_name')->nullable()->comment('智控品牌名称');
            $table->string('light_manufacturer')->nullable()->comment('灯光品牌标识');
            $table->string('light_name')->nullable()->comment('灯光品牌名称');
            $table->string('stereo_manufacturer')->nullable()->comment('音响品牌标识');
            $table->string('stereo_name')->nullable()->comment('音响品牌名称');
            $table->string('stereo_relation_name')->nullable()->comment('音响品牌联系人');
            $table->string('stereo_relation_phone')->nullable()->comment('音响品牌联系人电话');
            $table->string('management_system')->nullable()->comment('使用的管理系统');
            $table->string('demand_type')->nullable()->comment('使用的点播类型');
            $table->string('stb_hardware_model')->nullable()->comment('机顶盒硬件类型');
            $table->integer('company_id')->nullable()->comment('所关联的物联网ID')->index();
            $table->integer('confirmed_user_id')->nullable()->comment('信息确认人员的user_id （报备系统的）');
            $table->string('confirmed_user_name')->nullable()->comment('信息确认人员名称');
            $table->string('lon')->nullable()->comment('经度');
            $table->string('lat')->nullable()->comment('纬度');
            $table->smallInteger('status')->default('0')->comment('状态，0: 待清洗，1: 预清洗， 2: 已清洗');
            $table->boolean('is_valid')->nullable()->comment('是否合法');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('industry_companies');
    }
}
