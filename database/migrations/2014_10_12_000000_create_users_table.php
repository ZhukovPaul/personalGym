<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->rememberToken();
            $table->string('name');
            $table->string('lastname')->nullable();
            $table->date('birthday')->nullable();
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->set('gender',["male","female"])->nullable();
            $table->string('vk_id')->nullable();
            $table->string('github_id')->nullable();
            $table->string('google_id')->nullable();
            $table->string('yandex_id')->nullable();
            $table->string('fb_id')->nullable();
            $table->foreignId("user_image_id")
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
         
             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
