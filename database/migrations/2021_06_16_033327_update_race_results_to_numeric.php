<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRaceResultsToNumeric extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('race_results', function (Blueprint $table) {
            $table->renameColumn('best_lap_time', 'best_lap_time_legacy');
            $table->renameColumn('race_time', 'race_time_legacy');
        });

        Schema::table('race_results', function (Blueprint $table) {
            $table->integer('codemasters_result_status');
            $table->integer('laps_completed');

            $table->string('best_lap_time_legacy')->nullable()->change();
            $table->string('race_time_legacy')->nullable()->change();

            $table->float('best_lap_time', 8, 3);
            $table->float('race_time', 8, 3);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('race_results', function (Blueprint $table) {
        });
    }
}
