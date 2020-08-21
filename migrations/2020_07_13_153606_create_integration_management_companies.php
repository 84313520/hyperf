<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateIntegrationManagementCompanies extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('integration_management_companies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->index()->comment('场所 id');
            $table->smallInteger('type')->comment('来源的类型： 1. 联网场所 2. 模糊配置的场所 3. 报备系统的手动清洗的场所');
            $table->timestamps();
        });
        \Hyperf\DbConnection\Db::statement("ALTER TABLE `integration_management_companies` comment '管理系统商家清洗结果表'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intergration_management_companies');
    }
}
