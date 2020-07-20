<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->truncate();
        DB::table('departments')->insert([
            'department_name' => 'Fertility',
        ]);
        DB::table('departments')->insert([
            'department_name' => 'Gynaecology',
        ]);
        DB::table('departments')->insert([
            'department_name' => 'Obstetrics',
        ]);
    }
}
