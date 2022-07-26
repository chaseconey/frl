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
            $table->dropColumn('speedtrap_speed');
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
            $table->float('speedtrap_speed', 8, 3)->nullable();
        });
    }
};
