<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TargetgroupBwlistMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('targetgroup_bwlist_map', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('targetgroup_id');
            $table->foreign('targetgroup_id')->references('id')->on('targetgroup')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('bwlist_id');
            $table->foreign('bwlist_id')->references('id')->on('bwlist')->onUpdate('cascade')->onDelete('cascade');
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
