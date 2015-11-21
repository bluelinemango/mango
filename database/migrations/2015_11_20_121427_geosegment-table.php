<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GeosegmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * CREATE TABLE `gicapods`.`geosegment` (
    `ID` INT NOT NULL,
    `SEGMENT_NAME` VARCHAR(96) NOT NULL,
    `LAT` VARCHAR(96) NOT NULL,
    `LON` VARCHAR(96) NOT NULL,
    `SEGMENT_RADIUS_IN_MILE` INT NOT NULL,
    `GEO_SEGMENT_LIST_ID` INT NOT NULL,
    `DATE_CREATED` DATETIME NULL,
    `DATE_MODIFIED` DATETIME NULL,
    PRIMARY KEY (`SEGMENT_NAME`,`GEO_SEGMENT_LIST_ID`));
     */
    public function up()
    {
        Schema::create('geosegment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('segment_name',100);
            $table->string('lat',100);
            $table->string('lon',100);
            $table->integer('segment_radius');
            $table->string('list_type',100);
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
