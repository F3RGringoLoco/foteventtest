<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UsersTableSeeder::class);
        $this->call(PicturesTableSeeder::class);
        $this->call(TransactionsTableSeeder::class);
        $this->call(EventssTableSeeder::class);
        $this->call(CardsTableSeeder::class);
    }
}
