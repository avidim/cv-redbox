<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Client::truncate();

        // \App\Models\User::factory(10)->create();
        \App\Models\Client::factory(50)->create();
    }
}
