<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FiealdToModel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('model', function (Blueprint $table) {
            $table->text('positive_feature_used');
            $table->text('feature_score_map');
            $table->text('top_feature_score_map');
            $table->string('model_type');
            $table->decimal('cut_off_score',4,2);
            $table->integer('pixel_hit_recency_in_seconds');
            $table->text('positive_offer_id');
            $table->text('negative_offer_id');
            $table->integer('max_number_of_device_history_per_feature');
            $table->integer('max_number_of_negative_feature_to_pick');
            $table->integer('number_of_positive_device_to_be_used_for_modeling');
            $table->integer('number_of_negative_device_to_be_used_for_modeling');
            $table->integer('number_of_both_negative_positive_device_to_be_used');
            $table->timestamp('date_of_request_completion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
