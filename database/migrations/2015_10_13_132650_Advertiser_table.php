<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdvertiserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertiser', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('description');
            $table->boolean('status');
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('client')->onUpdate('cascade')->onDelete('cascade');
            $table->string('domain_name');
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
