<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            SourcesTableSeeder::class,
        ]);
        $seedTestData = false;
        if($seedTestData){
            $this->call([
                EstnamesTableSeeder::class,
                SpeciesTableSeeder::class,
                NotesTableSeeder::class,
                SourceSpecieTableSeeder::class,
            ]);
        }
    }
}
