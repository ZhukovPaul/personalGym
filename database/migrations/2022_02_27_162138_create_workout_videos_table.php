<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkoutVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workout_videos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId("workout_id")
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string("title");
            $table->string("src");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workout_videos');
    }
}
