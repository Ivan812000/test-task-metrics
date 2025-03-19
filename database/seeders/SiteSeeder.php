<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteSeeder extends Seeder
{
    public function run()
    {
        // Создаем первый сайт с фиксированным URL
        DB::table('sites')->insert([
            'name' => 'Localhost',
            'url' => 'http://127.0.0.1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        for ($i = 0; $i < 3; $i++) {
            DB::table('sites')->insert([
                'name' => 'Магазин ' . ($i + 2),
                'url' => 'http://example' . ($i + 2) . '.com',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
