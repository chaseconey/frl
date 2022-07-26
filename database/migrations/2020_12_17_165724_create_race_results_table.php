<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('race_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('race_id')->constrained();
            $table->foreignId('driver_id')->constrained();
            $table->unsignedInteger('grid_position');
            $table->unsignedInteger('num_pit_stops');
            $table->string('best_lap_time');
            $table->unsignedInteger('num_penalties');
            $table->unsignedInteger('penalty_seconds');
            $table->string('race_time');
            $table->string('tire_stints');
            $table->unsignedInteger('points');
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
        Schema::dropIfExists('race_results');
    }
};
