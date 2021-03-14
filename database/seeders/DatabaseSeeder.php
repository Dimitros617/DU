<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permition')->insert([
            'id' => 1,
            'name' => 'Nový',
            'possibility_read' => 0,
            'new_user' => 0,
            'edit_content' => 0,
            'edit_permitions' => 0,
        ]);
        DB::table('permition')->insert([
            'id' => 2,
            'name' => 'Žák',
            'possibility_read' => 1,
            'new_user' => 0,
            'edit_content' => 0,
            'edit_permitions' => 0,

        ]);
        DB::table('permition')->insert([
            'id' => 3,
            'name' => 'Učitel',
            'possibility_read' => 1,
            'new_user' => 1,
            'edit_content' => 1,
            'edit_permitions' => 1,

        ]);
            //Seed pro typy
        DB::table('element_types')->insert([
            'id' => 1,
            'name' => 'Nadpis',
            'blade' => 'title-element',
        ]);
        DB::table('element_types')->insert([
            'id' => 2,
            'name' => 'Text',
            'blade' => 'text-element',
        ]);
        DB::table('element_types')->insert([
            'id' => 3,
            'name' => 'Obrázek',
            'blade' => 'image-element',
        ]);
        DB::table('element_types')->insert([
            'id' => 4,
            'name' => 'Video',
            'blade' => 'video-element',
        ]);
    }
}
