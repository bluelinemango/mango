<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetgroupGeosegmentMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('targetgroup_geosegmentlist_map', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('targetgroup_id');
            $table->foreign('targetgroup_id')->references('id')->on('targetgroup')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('geosegmentlist_id');
            $table->foreign('geosegmentlist_id')->references('id')->on('geosegmentlist')->onUpdate('cascade')->onDelete('cascade');
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
