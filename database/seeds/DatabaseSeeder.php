<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(ProductTypeSeeder::class);
        $this->call(TownshipSeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(DivisionSeeder::class);
    }
}
