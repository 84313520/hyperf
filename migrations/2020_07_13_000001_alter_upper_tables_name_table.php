<?php

use Hyperf\DbConnection\Db;
use Hyperf\Database\Migrations\Migration;

class AlterUpperTablesNameTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Db::statement("ALTER TABLE `industry_companies` comment '行业场所表'");
        Db::statement("ALTER TABLE `intelligent_control_vendors` comment '智控厂商表'");
        Db::statement("ALTER TABLE `lost_order_reason_types` comment '丢单原因类型表'");
        Db::statement("ALTER TABLE `manage_types` comment '经营性质类型表'");
        Db::statement("ALTER TABLE `sale_model_types` comment '销售模式类型表'");
        Db::statement("ALTER TABLE `stereo_vendors` comment '音响厂商表'");
        Db::statement("ALTER TABLE `vod_vendors` comment 'VOD厂商表'");
        Db::statement("ALTER TABLE `chain_brands` comment '连锁品牌基础数据表'");
        Db::statement("ALTER TABLE `dianping_shops` comment '行业场所原始数据表'");
        Db::statement("ALTER TABLE `chain_brand_stores` comment '连锁品牌门店数据表'");
        Db::statement("ALTER TABLE `integration_companies` comment '集成场所表'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
}
