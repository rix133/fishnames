<?php

namespace Database\Seeders;

use App\Models\Specie;
use Illuminate\Database\Seeder;

class SourceSpecieTableSeeder extends Seeder
{
    public function run()
    {
        Specie::findOrFail(1)->sources()->sync(1);
        Specie::findOrFail(2)->sources()->sync([1,2]);
        Specie::findOrFail(3)->sources()->sync([3,2]);
    }
}
