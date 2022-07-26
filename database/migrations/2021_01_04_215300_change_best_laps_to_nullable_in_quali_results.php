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
        Schema::table('race_quali_results', function (Blueprint $table) {
            $table->float('best_s1_time', 8, 3)->nullable()->change();
            $table->float('best_s2_time', 8, 3)->nullable()->change();
            $table->float('best_s3_time', 8, 3)->nullable()->change();
            $table->float('lap_delta', 8, 3)->nullable()->change();
            $table->float('best_s1_delta', 8, 3)->nullable()->change();
            $table->float('best_s2_delta', 8, 3)->nullable()->change();
            $table->float('best_s3_delta', 8, 3)->nullable()->change();
            $table->float('speedtrap_speed', 8, 3)->nullable()->change();
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
            $table->float('best_s1_time', 8, 3)->nullable(false)->change();
            $table->float('best_s2_time', 8, 3)->nullable(false)->change();
            $table->float('best_s3_time', 8, 3)->nullable(false)->change();
            $table->float('lap_delta', 8, 3)->nullable(false)->change();
            $table->float('best_s1_delta', 8, 3)->nullable(false)->change();
            $table->float('best_s2_delta', 8, 3)->nullable(false)->change();
            $table->float('best_s3_delta', 8, 3)->nullable(false)->change();
            $table->float('speedtrap_speed', 8, 3)->nullable(false)->change();
        });
    }
};
