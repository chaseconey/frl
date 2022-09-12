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
        Schema::create('temp_race_quali_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('race_id')->constrained();
            $table->foreignId('driver_id')->nullable();
            $table->integer('racing_number');
            $table->string('name');
            $table->float('best_s1_time', 8, 3)->nullable();
            $table->float('best_s2_time', 8, 3)->nullable();
            $table->float('best_s3_time', 8, 3)->nullable();
            $table->float('lap_delta', 8, 3)->nullable();
            $table->float('best_s1_delta', 8, 3)->nullable();
            $table->float('best_s2_delta', 8, 3)->nullable();
            $table->float('best_s3_delta', 8, 3)->nullable();
            $table->foreignId('f1_team_id')->constrained();
            $table->unsignedInteger('position');
            $table->string('best_lap_tire')->nullable();
            $table->integer('codemasters_result_status');
            $table->float('best_lap_time', 8, 3);
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
        Schema::dropIfExists('temp_race_quali_results');
    }
};
