<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Service;
use Carbon\Carbon;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Service::truncate();
        // DB::table('services')->truncate();
        DB::table('services')->insert(
            [
                'srvcName' => 'Ask A Question',
                'srvcShortName' => 'AAQ',
                'srvcPrice' => 200.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
        DB::table('services')->insert(
            [
                'srvcName' => 'Video Call with Team Doctor',
                'srvcShortName' => 'VTD',
                'srvcPrice' => 500.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
        DB::table('services')->insert(
            [
                'srvcName' => 'Video Call with Expert Doctor',
                'srvcShortName' => 'VED',
                'srvcPrice' => 700.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
        DB::table('services')->insert(
            [
                'srvcName' => 'Clinic Appointment with Team Doctor',
                'srvcShortName' => 'CTD',
                'srvcPrice' => 400.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
        DB::table('services')->insert(
            [
                'srvcName' => 'Clinic Appointment with Expert Doctor',
                'srvcShortName' => 'CED',
                'srvcPrice' => 800.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
    }
}
