<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class AlterChainBrandStoreTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('chain_brand_stores', function (Blueprint $table) {
            $table->integer('company_id')->nullable()->comment('物联网 id');
            $table->integer('industry_company_id')->nullable()->comment('行业场所 id');
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
