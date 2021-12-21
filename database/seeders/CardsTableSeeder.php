<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Card;

class CardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Card::create([
            'user_id' => 2,
            'number' => '0987654321',
            'expiration_date' => '29 / 1/ 2021',
            'cvc' => 321,
        ]);
    }
}
