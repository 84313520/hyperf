<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateIndustryCompanyCleanConfirmLogsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('industry_company_clean_confirm_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('industry_company_id')->index();
            $table->json('old')->nullable()->comment('旧的记录');
            $table->json('new')->nullable()->comment('新的记录');
            $table->integer('confirmed_user_id')->nullable()->comment('报备系统的 user_id');
            $table->string('confirmed_user_name')->nullable()->comment('报备系统的 user_name');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('industry_company_clean_confirm_logs');
    }
}
