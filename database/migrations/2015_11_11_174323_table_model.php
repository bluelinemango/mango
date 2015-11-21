<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableModel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->unsignedInteger('advertiser_id');
            $table->foreign('advertiser_id')->references('id')->on('advertiser')->onUpdate('cascade')->onDelete('cascade');
            $table->string('seed_web_sites');
            $table->string('algo');
            $table->string('segment_name_seed');
            $table->string('process_result');
            $table->string('description');
            $table->integer('num_neg_devices_used');
            $table->integer('num_pos_devices_used');
            $table->integer('feature_recency_in_sec');
            $table->integer('max_num_both_neg_pos_devices');
            $table->text('negative_features_requested');
            $table->text('feature_avg_num_history_used');
            $table->text('negative_feature_used');
            $table->timestamp('date_of_request');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
