<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'hoang',
            'email' => 'manhhoang3151996@gmail.com',
            'password' => bcrypt('12345678')
        ];

        \App\User::create($data);
    }
}
