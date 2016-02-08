<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetgroupRealtimeInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('targetgroup_realtime_info', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('targetgroup_id');
            $table->foreign('targetgroup_id')->references('id')->on('targetgroup')->onUpdate('cascade')->onDelete('cascade');
            $table->string('today_date');
            $table->integer('impressions_shown_today_until_now');
            $table->integer('total_impression_show_until_now');
            $table->decimal('daily_budget_spent_today_until_now');
            $table->decimal('total_budget_spent_until_now');
            $table->timestamp('last_time_ad_shown');
            $table->string('target_group_pacing_status',45);
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
