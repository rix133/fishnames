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
                'name' => 'Test',
            ],
            [
                'id'    => 2,
                'name' => 'Loomade Elu',
            ],
            [
                'id'    => 3,
                'name' => 'AV',
            ],
        ];

        Source::insert($items);
    }
}
