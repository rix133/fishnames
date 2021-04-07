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
                'user_id' => 1,
                'latin_name'     => 'Limanda limanda',
                'eng_name'       => 'Dab',
                'confirmed_estname_id'     => 1,
            ],
            [
                'id'             => 2,
                'user_id' => 1,
                'latin_name'     => 'Salmo salar',
                'eng_name'       => 'Atlantic salmon',
                'source_id'      => 2,
                'latin_family'   => "Salmonidae",
                'describer'       => "Linnaeus",
                "year_described" =>  1758,
                'photo_path'     =>  'https://inaturalist-open-data.s3.amazonaws.com/photos/51387235/small.jpeg?1568528060'
            ],
            [
                'id'             => 3,
                'user_id' => 1,
                'latin_name'     => 'Oncorhynchus mykiss',
                'eng_name'       => 'Rainbow trout',
                'source_id'      => 3,
                'latin_family'   => "Salmonidae",
                "year_described" =>  1792,
                'photo_path'     =>  'https://static.inaturalist.org/photos/71244986/small.jpg?1588643876'
            ],
            [
                'id'             => 4,
                'user_id' => 1,
                'latin_name'     => 'Oncorhynchus',
                'is_genus'       => true,
                'latin_family'   => "Salmonidae",
                "year_described" =>  1792,
                'photo_path'     =>  'https://static.inaturalist.org/photos/71244986/small.jpg?1588643876'
            ],
            [
                'id'             => 5,
                'user_id' => 1,
                'latin_name'     => 'Salmo mykiss',
                'eng_name'       => 'Rainbow trout',
                'new_id'         => 3,
                'source_id'      => 2,
                'latin_family'   => "Salmonidae",
                "year_described" =>  1792,
                'photo_path'     =>  'https://static.inaturalist.org/photos/71244986/small.jpg?1588643876'
            ],
            ];
        
        Specie::insert($species[0]);
        Specie::insert($species[1]);
        Specie::insert($species[2]);
        Specie::insert($species[3]);
        Specie::insert($species[4]);
       
    }
}
