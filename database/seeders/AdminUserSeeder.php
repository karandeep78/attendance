<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create admin role if not exists
        $role = DB::table('roles')->where('slug', 'admin')->first();
        
        if (!$role) {
            $roleId = DB::table('roles')->insertGetId([
                'name' => 'Administrator',
                'slug' => 'admin',
                'permissions' => json_encode(['*']), // All permissions
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $roleId = $role->id;
        }

        // Create admin user
        $userId = DB::table('users')->insertGetId([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'), // Change this password in production
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Assign admin role to the user
        DB::table('role_users')->insert([
            'user_id' => $userId,
            'role_id' => $roleId
        ]);
    }
}
