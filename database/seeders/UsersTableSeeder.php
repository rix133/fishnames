<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Richard (Admin)',
                'email'          => 'rix133@ut.ee',
                'password'       => bcrypt('asdf1234'),
                'remember_token' => null,
            ],
            [
                'id'             => 2,
                'name'           => 'Richard (Juht)',
                'email'          => 'richard.meitern@ut.ee',
                'password'       => bcrypt('asdf1234'),
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
