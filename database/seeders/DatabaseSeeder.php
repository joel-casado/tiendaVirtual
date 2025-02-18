<?php

use Illuminate\database\Seeder;
use Database\Seeders\CompradoresSeeder;
class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(CompradoresSeeder::class);
    }
}
