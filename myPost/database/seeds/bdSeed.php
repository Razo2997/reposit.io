<?php

use App\Post;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class bdSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Razo',
            'email'=>'razin.abrahamyan@mail.ru',
            'password'=>Hash::make('123456789'),
            'role'=>'admin'
        ]);
        for($i = 0;$i < 100; $i++){
            User::create([
                'name' => Str::random(7),
                'email'=>Str::random(10).'@mail.ru',
                'password'=>Hash::make('12345678'),
                'role'=>'user'
            ]);
        }
        $arr = ['8HmiMiHgAz5STdx9mS4Ipexels-photo-466685.jpeg','iCBGa0VmW8tC6tHVyI0apexels-photo-170811.jpeg','jiXTi4e2nBS6I8P3PeYSimage.jpg','NpVIKjw9zGmLJRQr0HJlphoto.jpg','oY4quYOfwrIaCzyKwHt7img_snow.jpg'];
        for($i = 0;$i < 100; $i++){
            Post::create([
                'title'=>Str::random(7),
                'subtitle'=>Str::random(15),
                'text'=>str_shuffle('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto asperiores atque beatae, cumque ex facilis itaque laboriosam magnam nam obcaecati officiis porro possimus provident, quaerat quas quasi recusandae reiciendis sit'),
                'image'=> $arr[rand(0,4)]

            ]);
        }

    }
}
