<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_access',
            ],
            [
                'id'    => 2,
                'title' => 'species_access',
            ],
            [
                'id'    => 3,
                'title' => 'estname_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
