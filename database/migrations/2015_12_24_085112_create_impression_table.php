<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateImpressionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('impression', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('targetgroup_id');
            $table->foreign('targetgroup_id')->references('id')->on('targetgroup')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('creative_id');
            $table->foreign('creative_id')->references('id')->on('creative')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('campaign_id');
            $table->foreign('campaign_id')->references('id')->on('campaign')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('advertiser_id');
            $table->foreign('advertiser_id')->references('id')->on('advertiser')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('client')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('geosegment_id');
            $table->foreign('geosegment_id')->references('id')->on('geosegment')->onUpdate('cascade')->onDelete('cascade');
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
