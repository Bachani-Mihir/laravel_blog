<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        \App\Models\category::factory(3)->create();
        User::factory(10)->create();
        \App\Models\Post::factory(10)->create();
    }
}
