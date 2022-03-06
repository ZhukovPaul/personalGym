<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table("user_groups")->insert(["title"=>"Administrators","slug"=>"admin"]);
        DB::table("user_groups")->insert(["title"=>"Registred users","slug"=>"registred"]);

        //App\Models\UserGroup
        // User::factory(10)->create();
    }
}
