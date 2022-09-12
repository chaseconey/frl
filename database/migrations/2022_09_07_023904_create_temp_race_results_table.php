<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_race_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('race_id')->constrained();
            $table->foreignId('driver_id')->nullable();
            $table->integer('racing_number');
            $table->string('name');
            $table->foreignId('f1_team_id')->constrained();
            $table->unsignedInteger('position');
            $table->unsignedInteger('grid_position');
            $table->unsignedInteger('num_pit_stops');
            $table->unsignedInteger('num_penalties');
            $table->unsignedInteger('penalty_seconds');
            $table->string('tire_stints');
            $table->unsignedInteger('points');
            $table->integer('codemasters_result_status');
            $table->integer('laps_completed');
            $table->float('best_lap_time', 8, 3);
            $table->float('race_time', 8, 3);
            $table->json('lap_data')->nullable();
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
        Schema::dropIfExists('temp_race_results');
    }
};
