<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OfferPixelMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_pixel_map', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('offer_id');
            $table->foreign('offer_id')->references('id')->on('offer')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('pixel_id');
            $table->foreign('pixel_id')->references('id')->on('pixel')->onUpdate('cascade')->onDelete('cascade');
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
