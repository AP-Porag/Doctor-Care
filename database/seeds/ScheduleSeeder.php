<?php

use Illuminate\Database\Seeder;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schedule::create([
            'doctor_id' => '4',
            'weekday' => 'Monday',
            'start_time' => '10:00',
            'end_time' => '12:00',
        ]);
    }
}
