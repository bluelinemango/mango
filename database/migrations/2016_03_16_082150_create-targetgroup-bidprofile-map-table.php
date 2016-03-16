<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetgroupBidprofileMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('targetgroup_bidprofile_map', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bid_profile_id');
            $table->foreign('bid_profile_id')->references('id')->on('bid_profile')->onUpdate('cascade')->onDelete('cascade');
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
