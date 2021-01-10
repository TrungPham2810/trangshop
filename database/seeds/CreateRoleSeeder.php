<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name'=> 'admin','display_name'=>'Administrator'],
            ['name'=> 'customer','display_name'=>'Customer'],
            ['name'=> 'developer','display_name'=>'Developer'],
            ['name'=> 'editor','display_name'=>'Editor'],
        ]);
    }
}
