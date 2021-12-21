<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transaction::create([
            'image_name' => '3rdPic',
            'owner_id' => 3,
            'owner_name' => 'Operador1',
            'buyer_id' => 2,
            'buyer_name' => 'operadortest',
            'amount' => 10,
        ]);
    }
}
