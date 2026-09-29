<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            ['namauser' => 'Administrator', 'username' => 'admin',  'password' => 'admin123',  'role' => 'admin'],
            ['namauser' => 'Waiter Satu',   'username' => 'waiter', 'password' => 'waiter123', 'role' => 'waiter'],
            ['namauser' => 'Kasir Satu',    'username' => 'kasir',  'password' => 'kasir123',  'role' => 'kasir'],
            ['namauser' => 'Owner',         'username' => 'owner',  'password' => 'owner123',  'role' => 'owner'],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
