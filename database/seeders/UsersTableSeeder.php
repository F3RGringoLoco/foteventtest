<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name' => 'admin',
            'password' => bcrypt(1234),
            'email' => 'admin@gmail.com',
            'image' => 'noimage.jpg',
            'phone' => '12345678',
            'is_client' => false,
        ]);

        User::create([
            'name' => 'operadortest',
            'password' => bcrypt(12345678),
            'email' => 'operadortest@gmail.com',
            'image' => 'noimage.jpg',
            'phone' => '12345678',
            'is_client' => true,
        ]);

        User::create([
            'name' => 'operador1',
            'password' => bcrypt(12345678),
            'email' => 'operador1@gmail.com',
            'image' => 'noimage.jpg',
            'phone' => '12345678',
            'is_client' => false,
        ]);

        

    }
}
