<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CampaignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->unsignedInteger('advertiser_id');
            $table->foreign('advertiser_id')->references('id')->on('advertiser')->onUpdate('cascade')->onDelete('cascade');
            $table->string('description');
            $table->boolean('status');
            $table->integer('max_impression');
            $table->integer('daily_max_impression');
            $table->integer('max_budget');
            $table->integer('daily_max_budget');
            $table->integer('cpm');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->string('advertiser_domain_name');
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
