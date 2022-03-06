<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workouts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("title");
            $table->string("slug");
            $table->text("description")->nullable(); 
            $table->foreignId("workout_section_id")
            ->nullable()
            ->constrained()
            ->onUpdate('SET NULL')
            ->onDelete('SET NULL');
            $table->foreignId("type_workout_id")
            ->nullable()
            ->constrained()
            ->onUpdate('SET NULL')
            ->onDelete('SET NULL');
            $table->foreignId("workout_image_id")
            ->nullable()
            ->constrained()
            ->onUpdate('SET NULL')
            ->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workouts');
    }
}
