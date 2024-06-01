<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('users')->insert([
            'firstName' => 'sys',
            'lastName' => 'Admin',
            'email' => 'sysAdmin@example.com',
            'picture' => 'pictures/3677719.png', 
            'password' => Hash::make('12345678'), 
            'idRole' => 4, 
            'active' => 1,
            'school_id' => 1
        ]);
    }
}
