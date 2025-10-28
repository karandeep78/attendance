<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Hash;
use Spatie\Permission\Traits\HasRoles;
use DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Ensure admin user and role exist (idempotent)
        $user = User::firstOrCreate(
            ['email' => 'admin@ams.com'],
            ['name' => 'Admin', 'password' => Hash::make('admin@ams.com')]
        );

        $role = Role::firstOrCreate(
            ['slug' => 'admin'],
            ['name' => 'Adminstrator']
        );

        // Attach the role to the user (sync with role id)
        $user->roles()->sync([$role->id]);
        
        // Run the schedule seeder
        $this->call(ScheduleSeeder::class);

        // Create a convenience user for karan if it doesn't exist
        if (!User::where('email', 'karan@gmail.com')->exists()) {
            User::create([
                'name' => 'Karan',
                'email' => 'karan@gmail.com',
                'password' => Hash::make('karan@123'),
            ]);
        }
    }
}
