<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\SiteSeeder;
use Database\Seeders\ClickSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(SiteSeeder::class);
        $this->call(ClickSeeder::class);
    }
}
