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
        Schema::create('protests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('race_id')->constrained();
            $table->foreignId('driver_id')->constrained();

            $table->unsignedBigInteger('protested_driver_id');
            $table->foreign('protested_driver_id')->references('id')->on('drivers');

            $table->string('video_url');
            $table->text('rules_breached');
            $table->text('description');

            $table->text('stewards_decision')->nullable();

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
        Schema::dropIfExists('protests');
    }
};
