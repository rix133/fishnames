<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Source;

class SourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'id'    => 1,
                'user_id' => 1,
                'name' => 'Komisjon',
                'description' => 'Selle komisjoni poolt sisestatud nimi'
            ],
            [
                'id'    => 2,
                'user_id' =>1,
                'name' => 'Loomade Elu',
                'description' => null
            ],
            [
                'id'    => 3,
                'user_id' => 1,
                'name' => 'AV',
                'description' => null
            ],
            [
                'id'    => 4,
                'user_id' => 1,
                'name' => 'Teadmata',
                'description' => 'Selline allikas, mille päritolu pole võimalik määrata'
            ],
        ];

        Source::insert($items);
    }
}
