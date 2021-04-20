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
                'description' => "Äkki Atlandi lõhe oleks parem",
                'user_id'=> 2,
                'estname_id'=> 2,
                'updated_at' => date("Y-m-d H:i:s",strtotime("+1 day")),
                'created_at' => date("Y-m-d H:i:s"),
            ],
        ];
        Note::insert($notes);
    }
}
