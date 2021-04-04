<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCodemastersIdToF1Teams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('f1_teams', function (Blueprint $table) {
            $table->integer('codemasters_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('f1_teams', function (Blueprint $table) {
            $table->dropColumn('codemasters_id');
        });
    }
}
