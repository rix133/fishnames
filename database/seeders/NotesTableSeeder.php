<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Note;

class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notes =[
            [
                'id' => 1,
                'description' => "see on nõme",
                'user_id'=> 2,
                'estname_id'=> 2,
            ],
        ];
        Note::insert($notes);
    }
}
