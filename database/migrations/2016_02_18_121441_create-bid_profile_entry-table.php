<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidProfileEntryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bid_profile_entry', function (Blueprint $table) {
            $table->increments('id');
            $table->string('domain',45);
            $table->string('bid_strategy',45);
            $table->decimal('bid_value');
            $table->string('status',15);
            $table->unsignedInteger('bid_profile_id');
            $table->foreign('bid_profile_id')->references('id')->on('bid_profile')->onUpdate('cascade')->onDelete('cascade');
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
