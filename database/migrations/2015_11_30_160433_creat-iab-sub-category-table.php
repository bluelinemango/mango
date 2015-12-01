<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatIabSubCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iab_sub_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('iab_category_id');
            $table->foreign('iab_category_id')->references('id')->on('iab_category')->onUpdate('cascade')->onDelete('cascade');
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
