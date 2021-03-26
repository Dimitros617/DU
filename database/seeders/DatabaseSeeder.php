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
            'default' => 1,
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
            'name' => 'Text',
            'svg' => 'fonts.svg',
            'blade' => 'text-element',
        ]);
        DB::table('element_types')->insert([
            'id' => 2,
            'name' => 'Obrázek',
            'svg' => 'image.svg',
            'blade' => 'image-element',
        ]);
        DB::table('element_types')->insert([
            'id' => 3,
            'name' => 'Video',
            'svg' => 'video.svg',
            'blade' => 'video-element',
        ]);
        DB::table('element_types')->insert([
            'id' => 4,
            'name' => 'Dokončit',
            'svg' => 'finish.svg',
            'blade' => 'finish-element',
        ]);

        DB::table('element_types')->insert([
            'id' => 5,
            'name' => 'Stáhnout zadání',
            'svg' => 'download.svg',
            'blade' => 'download-element',
        ]);

        DB::table('element_types')->insert([
            'id' => 6,
            'name' => 'Nahrát zadání',
            'svg' => 'upload.svg',
            'blade' => 'upload-element',
        ]);

        DB::table('element_types')->insert([
            'id' => 7,
            'name' => 'ABC Test',
            'svg' => 'check.svg',
            'blade' => 'abc-test-element',
        ]);

        DB::table('element_types')->insert([
            'id' => 8,
            'name' => ' Otevřený Test',
            'svg' => 'pencil.svg',
            'blade' => 'open-test-element',
        ]);
    }
}
