<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BwentriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
    CREATE TABLE `gicapods`.`bwEntries` (
    `ID` INT NOT NULL,
    `DOMAIN_NAME` VARCHAR(96) NOT NULL,
    PRIMARY KEY (`BW_LIST_ID`, `DOMAIN_NAME`));

     *
     */
    public function up()
    {
        Schema::create('bwentries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('domain_name',100);
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
