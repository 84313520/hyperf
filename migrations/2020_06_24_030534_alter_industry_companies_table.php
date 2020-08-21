<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class AlterIndustryCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('industry_companies', function (Blueprint $table) {
            $table->dropColumn('lon');
            $table->string('lng')->nullable()->comment('经度');
            $table->string('company_relation_name')->nullable()->comment('场所联系人');
            $table->string('company_relation_phone')->nullable()->comment('场所联系人电话');
            $table->integer('boxes')->default(0)->comment('包厢数');
            $table->dateTime('open_time')->nullable()->comment('开业时间');
            $table->boolean('operating_state')->nullable()->comment('营业状态, 0 停业, 1 正常, 2 关闭');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
}
