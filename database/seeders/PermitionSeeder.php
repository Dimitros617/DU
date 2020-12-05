<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermitionSeeder extends Seeder
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
            'name' => 'unverifiedUser',
            'possibility_renting' => 0,
            'new_user' => 0,
            'return_verification' => 0,
            'edit_item' => 0,
        ]);
        DB::table('permition')->insert([
            'id' => 2,
            'name' => 'verifiedUser',
            'possibility_renting' => 1,
            'new_user' => 0,
            'return_verification' => 0,
            'edit_item' => 0,
        ]);
        DB::table('permition')->insert([
            'id' => 3,
            'name' => 'Admin',
            'possibility_renting' => 1,
            'new_user' => 1,
            'return_verification' => 1,
            'edit_item' => 1,
        ]);
    }
}
