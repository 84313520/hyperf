<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateChainBrandsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chain_brands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('连锁门店名称');
            $table->string('relation_name')->comment('负责人');
            $table->string('relation_phone')->comment('联系电话');
            $table->string('agent_name')->nullable()->comment('代理商名称');
            $table->integer('agent_id')->nullable()->comment('agent 表的 id');
            $table->boolean('is_shiyi')->default(false)->comment('是否是视易, 0 不是, 1 是');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chain_brands');
    }
}
