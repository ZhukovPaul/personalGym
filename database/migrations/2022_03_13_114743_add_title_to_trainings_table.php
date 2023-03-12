<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleToTrainingsTable extends Migration
{
    public function up(): void
    {
        Schema::table('trainings', function (Blueprint $table) {
            $table->string('title')->nullable()->after('updated_at');
        });
    }

    public function down(): void
    {
        Schema::table('trainings', function (Blueprint $table) {
            //
        });
    }
}
