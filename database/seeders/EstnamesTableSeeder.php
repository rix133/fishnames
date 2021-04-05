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
                'source_id'    => 1,
                'user_id'       =>1,
                'est_name'       => "Soomuslest",
                'accepted'     => 1,
                'in_termeki'     => 1,
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id'             => 2,
                'specie_id'     => 2,
                'source_id'      => 2,
                'user_id'       =>2,
                'est_name'       => "Lõhe",
                'in_termeki'     => 0,
                'accepted'     => 0,
                'updated_at' => date("Y-m-d H:i:s"),

           ],
            [
                'id'             => 3,
                'specie_id'     => 2,
                'source_id'      => 3,
                'user_id'       =>1,
                'est_name'       => "Lõhi",
                'accepted'     => 0,
                'in_termeki'     => 0,
                'updated_at' => date("Y-m-d H:i:s"),

            ],

            ];

        Estname::insert($names);
    }
}
