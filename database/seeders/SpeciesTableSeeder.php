<?php

namespace Database\Seeders;

use App\Models\Specie;
use Illuminate\Database\Seeder;

class SpeciesTableSeeder extends Seeder
{
    public function run()
    {
        $species = [
            [
                'id'             => 1,
                'user_id' => 2,
                'latin_name'     => 'Limanda limanda',
                'eng_name'       => 'Dab',
                'describer'       => "Linnaeus",
                "year_described" =>  '1758-86',
                'confirmed_estname_id'     => 1,
                'updated_at' => date("Y-m-d H:i:s", strtotime("+1 day")),
            ],
            [
                'id'             => 2,
                'user_id' => 2,
                'latin_name'     => 'Salmo salar',
                'eng_name'       => 'Atlantic salmon',
                'latin_family'   => "Salmonidae",
                'describer'       => "Linnaeus",
                "year_described" =>  '1758',
                'photo_path'     =>  'https://inaturalist-open-data.s3.amazonaws.com/photos/51387235/small.jpeg?1568528060',
                'updated_at' => date("Y-m-d H:i:s",strtotime("+1 day")),
            ],
            [
                'id'             => 3,
                'user_id' =>   1,
                'latin_name'     => 'Oncorhynchus mykiss',
                'eng_name'       => 'Rainbow trout',
                'latin_family'   => "Salmonidae",
                'describer'       => "Walbaum",
                "year_described" =>  1792,
                'photo_path'     =>  'https://static.inaturalist.org/photos/71244986/small.jpg?1588643876',
                'updated_at' => date("Y-m-d H:i:s", strtotime("+1 day")),
            ],
            [
                'id'             => 4,
                'user_id' => 1,
                'latin_name'     => 'Oncorhynchus',
                'is_genus'       => true,
                'latin_family'   => "Salmonidae",
                'describer'       => "Walbaum",
                "year_described" =>  1792,
                'photo_path'     =>  'https://static.inaturalist.org/photos/71244986/small.jpg?1588643876',
                'updated_at' => date("Y-m-d H:i:s", strtotime("+1 day")),
            ],
            [
                'id'             => 5,
                'user_id' => 1,
                'latin_name'     => 'Salmo mykiss',
                'eng_name'       => 'Rainbow trout',
                'new_id'         => 3,
                'latin_family'   => "Salmonidae",
                'describer'       => "Walbaum",
                "year_described" =>  1792,
                'photo_path'     =>  'https://static.inaturalist.org/photos/71244986/small.jpg?1588643876',
                'updated_at' => date("Y-m-d H:i:s", strtotime("+1 day")),
            ],
            ];
        
        Specie::insert($species[0]);
        Specie::insert($species[1]);
        Specie::insert($species[2]);
        Specie::insert($species[3]);
        Specie::insert($species[4]);
       
    }
}
