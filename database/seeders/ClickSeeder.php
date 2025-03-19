<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClickSeeder extends Seeder
{
    public function run()
    {
        $site_id = 1;

        for ($hour = 0; $hour < 24; $hour++) {
            if ($hour % 2 === 0) {
                $x = 200;
                $y = 300;
                $clicksCount = 20;
            } else {
                $x = rand(100, 500);
                $y = rand(100, 500);
                $clicksCount = 10;
            }

            for ($i = 0; $i < $clicksCount; $i++) {
                DB::table('clicks')->insert([
                    'site_id' => $site_id,
                    'x' => $x,
                    'y' => $y,
                    'url' => 'http://127.0.0.1',
                    'timestamp' => Carbon::now()->startOfDay()->addHours($hour),
                    'created_at' => Carbon::now()->startOfDay()->addHours($hour),
                    'updated_at' => Carbon::now()->startOfDay()->addHours($hour),
                ]);
            }
        }
    }
}
