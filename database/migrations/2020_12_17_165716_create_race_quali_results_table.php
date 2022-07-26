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
        Schema::create('race_quali_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('race_id')->constrained();
            $table->foreignId('driver_id')->constrained();
            $table->string('best_lap_time');
            $table->float('best_s1_time', 8, 3);
            $table->float('best_s2_time', 8, 3);
            $table->float('best_s3_time', 8, 3);
            $table->float('lap_delta', 8, 3);
            $table->float('best_s1_delta', 8, 3);
            $table->float('best_s2_delta', 8, 3);
            $table->float('best_s3_delta', 8, 3);
            $table->float('speedtrap_speed', 8, 3);
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
        Schema::dropIfExists('race_quali_results');
    }
};
