<?php

namespace Database\Seeders;

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
        $schedules = [
            [
                'slug' => 'morning-shift',
                'time_in' => '09:00:00',
                'time_out' => '17:00:00',
            ],
            [
                'slug' => 'afternoon-shift',
                'time_in' => '13:00:00',
                'time_out' => '21:00:00',
            ],
            [
                'slug' => 'night-shift',
                'time_in' => '21:00:00',
                'time_out' => '05:00:00',
            ],
        ];

        foreach ($schedules as $schedule) {
            Schedule::create($schedule);
        }
    }
}