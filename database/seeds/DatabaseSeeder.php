<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Department;
use App\database\seeds\AdminSeeder;
use App\database\seeds\DepartmentSeeder;
use App\database\seeds\ServicesSeeder;

class DatabaseSeeder extends Seeder
{
    

    // private function __construct()
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = new AdminSeeder;
        $service = new DepartmentSeeder;
        $department = new ServicesSeeder;

        $admin->run();
        $service->run();
        $department->run();
    }
}
