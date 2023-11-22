<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Role::create(['name' => 'staff']);
        Role::create(['name' => 'student']);

        $staff = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'phone' => '123123123',
            'password' => Hash::make('secret')
        ]);

        $user = User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'phone' => '1234567890',
            'password' => Hash::make('secret')
        ]);

        $staff->assignRole('staff');
        $user->assignRole('student');
    }
}
