<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estname;

class EstnamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            [
                'id'             => 1,
                'specie_id'     => 1,
                'user_id'       =>1,
                'est_name'       => "Soomuslest",
                'accepted'     => 1,
            ],
            [
                'id'             => 2,
                'specie_id'     => 2,
                'user_id'       =>2,
                'est_name'       => "Lõhe",
                'accepted'     => 0,

           ],
            [
                'id'             => 3,
                'specie_id'     => 2,
                'user_id'       =>1,
                'est_name'       => "Lõhi",
                'accepted'     => 0,

            ],

            ];

        Estname::insert($names);
    }
}
