<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement(DB::raw("TRUNCATE menu"));

        DB::table('menu')->insert([
            'name' => 'Pengguna',
            'url' => '',
            'icons' => 'fa-users',
            'order' => 1,
        ]);

        DB::table('menu')->insert([
            'name' => 'Menu',
            'url' => 'menu',
            'parent_id' => 1,
            'icons' => '',
            'order' => 1,
        ]);

        DB::table('roles')->insert([
            'user_id' => 1,
            'menu_id' => 1
        ]);
    }
}
