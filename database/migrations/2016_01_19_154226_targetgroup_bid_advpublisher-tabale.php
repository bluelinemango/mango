<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TargetgroupBidAdvpublisherTabale extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('targetgroup_bid_advpublisher', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bid_price');
            $table->unsignedInteger('advertiser_publisher_id');
            $table->foreign('advertiser_publisher_id')->references('id')->on('advertiser_publisher')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('targetgroup_id');
            $table->foreign('targetgroup_id')->references('id')->on('targetgroup')->onUpdate('cascade')->onDelete('cascade');
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
