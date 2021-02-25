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
                'latin_name'     => 'Limanda limanda',
                'eng_name'       => 'Dab',
                'estname_id'     => 1,
            ],
            [
                'id'             => 2,
                'latin_name'     => 'Salmo salar',
                'eng_name'       => 'Atlantic salmon',
                'latin_genus'    => "Salmo",
                'latin_family'   => "Salmonidae",
                'describer'       => "Linnaeus",
                "year_described" =>  1758,
                'photo_path'     =>  'https://inaturalist-open-data.s3.amazonaws.com/photos/51387235/small.jpeg?1568528060'
            ],
            [
                'id'             => 3,
                'latin_name'     => 'Oncorhynchus kisutch',
                'eng_name'       => 'Coho salmon',
                'latin_genus'    => "Oncorhynchus",
                'latin_family'   => "Salmonidae",
                "year_described" =>  1792,
                'photo_path'     =>  'https://static.inaturalist.org/photos/71244986/small.jpg?1588643876'
            ],

            ];
        
        Specie::insert($species[0]);
        Specie::insert($species[1]);
        Specie::insert($species[2]);
        
    }
}
