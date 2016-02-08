<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignRealtimeInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_realtime_info', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('campaign_id');
            $table->foreign('campaign_id')->references('id')->on('campaign')->onUpdate('cascade')->onDelete('cascade');
            $table->string('today_date');
            $table->integer('impressions_shown_today_until_now');
            $table->integer('total_impression_show_until_now');
            $table->decimal('daily_budget_spent_today_until_now');
            $table->decimal('total_budget_spent_until_now');
            $table->timestamp('last_time_ad_shown');
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
