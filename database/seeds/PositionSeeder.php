<?php

use Illuminate\Database\Seeder;
use App\Model\AccountSetup\Position;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = array([
            'name' => 'Director General'
        ],[
            'name' => 'Deputy Director General',
        ],[
            'name' => 'Director',
        ],[
            'name' => 'Deputy Director',
        ],[
            'name' => 'Assistant General',
        ]);

        Position::truncate();

        foreach($positions as $position) {
            // dd($position);
            Position::create($position);
        }
    }
}