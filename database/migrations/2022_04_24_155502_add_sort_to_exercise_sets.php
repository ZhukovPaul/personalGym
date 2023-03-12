<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSortToExerciseSets extends Migration
{
    public function up(): void
    {
        Schema::table('exercise_sets', function (Blueprint $table) {
            $table->integer('sort')->default(100)->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('exercise_sets', function (Blueprint $table) {
            $table->dropColumn('sort');
        });
    }
}
