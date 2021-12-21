<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Evento;

class EventssTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Evento::create([
            'name' => 'Klaus',
            'date' => '30 / 12/ 2021',
            'time' => '7:15 PM',
            'location' => 'Emperador Urubo',
            'host_id' => '2',
            'host_name' => 'operadortest',
        ]);

        Evento::create([
            'name' => 'Blay',
            'date' => '30 / 12/ 2021',
            'time' => '7:15 PM',
            'location' => 'Urubo Golf',
            'host_id' => '2',
            'host_name' => 'operadortest',
            'photographer_id' => 3,
            'photographer_name' => 'Operador1',
        ]);
    }
}
