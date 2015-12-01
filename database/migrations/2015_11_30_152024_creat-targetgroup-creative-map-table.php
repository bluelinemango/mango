<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatTargetgroupCreativeMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('targetgroup_creative_map', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('targetgroup_id');
            $table->foreign('targetgroup_id')->references('id')->on('targetgroup')->onUpdate('cascade')->onDelete('cascade');
             $table->unsignedInteger('creative_id');
            $table->foreign('creative_id')->references('id')->on('creative')->onUpdate('cascade')->onDelete('cascade');
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
