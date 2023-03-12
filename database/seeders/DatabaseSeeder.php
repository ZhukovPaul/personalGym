<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('user_groups')->insert(['title'=>'Administrators', 'slug'=>'admin']);
        DB::table('user_groups')->insert(['title'=>'Registred users', 'slug'=>'registred']);
        // User::factory(10)->create();
    }
}
