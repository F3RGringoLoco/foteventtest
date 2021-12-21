<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Picture;

class PicturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Picture::create([
            'image_name' => '1stPic',
            'address' => '1stPic_1639981674.jpg',
            'user_id' => 3,
        ]);

        Picture::create([
            'image_name' => '3rdPic',
            'address' => '3rdPic_1639981674.jpg',
            'amount' => 10,
            'user_id' => 3,
        ]);

        Picture::create([
            'image_name' => '4thPic',
            'address' => '4thPic_1639981674.jpg',
            'user_id' => 3,
        ]);

        Picture::create([
            'image_name' => '6thPic',
            'address' => '6thPic_1639981674.jpg',
            'amount' => 90,
            'user_id' => 3,
        ]);

        Picture::create([
            'image_name' => '7thPic',
            'address' => '7thPic_1639981674.jpeg',
            'user_id' => 3,
        ]);
    }
}
