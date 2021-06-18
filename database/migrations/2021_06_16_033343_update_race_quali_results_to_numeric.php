<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRaceQualiResultsToNumeric extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('race_quali_results', function (Blueprint $table) {
            $table->renameColumn('best_lap_time', 'best_lap_time_legacy');
        });

        Schema::table('race_quali_results', function (Blueprint $table) {
            $table->string('best_lap_time_legacy')->nullable()->change();

            $table->integer('codemasters_result_status');
            $table->float('best_lap_time', 8, 3);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('race_quali_results', function (Blueprint $table) {
        });
    }
}