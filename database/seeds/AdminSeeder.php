<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'firstName' => 'Admin',
            'lastName' => 'User',
            'phoneNo' => '0000000000',
            'category' => 'admin',
            'gender' => 'Male',
            'salutation' => 'Mr.',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);
    }
}
