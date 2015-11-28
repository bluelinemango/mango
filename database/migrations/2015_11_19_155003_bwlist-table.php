<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BwlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void

    CREATE TABLE `gicapods`.`bwList` (
    `ID` INT NOT NULL,
    `NAME` VARCHAR(45) NOT NULL,
    `LIST_TYPE` VARCHAR(45) NULL,
    `ADVERTISER_ID` INT NOT NULL,
    `DATE_CREATED` DATETIME NULL,
    `DATE_MODIFIED` DATETIME NULL,
    PRIMARY KEY (`NAME,ADVERTISER_ID`));
     *
     */


    public function up()
    {
        Schema::create('bwlist', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('list_type',100);
            $table->unsignedInteger('advertiser_id');
            $table->foreign('advertiser_id')->references('id')->on('advertiser')->onUpdate('cascade')->onDelete('cascade');
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
