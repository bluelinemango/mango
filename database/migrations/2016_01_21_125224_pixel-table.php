<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PixelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pixel', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->unsignedInteger('advertiser_id');
            $table->foreign('advertiser_id')->references('id')->on('advertiser')->onUpdate('cascade')->onDelete('cascade');
            $table->string('part_a',100);
            $table->string('part_b',100);
            $table->string('version',100);
            $table->string('description',100);
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
