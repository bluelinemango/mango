<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TargetgroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('targetgroup', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->unsignedInteger('campaign_id');
            $table->foreign('campaign_id')->references('id')->on('campaign')->onUpdate('cascade')->onDelete('cascade');
            $table->string('description');
            $table->boolean('status');
            $table->string('iab_category');
            $table->string('iab_sub_category');
            $table->integer('max_impression');
            $table->integer('daily_max_impression');
            $table->integer('max_budget');
            $table->integer('daily_max_budget');
            $table->string('pacing_plan');
            $table->integer('cpm');
            $table->integer('frequency_in_sec');
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
