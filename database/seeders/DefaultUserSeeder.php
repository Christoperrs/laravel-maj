<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Super Admin User
        $superAdmin = User::create([
            'name' => 'SuperAdmin', 
            'email' => 'super@maj.com',
            'password' => Hash::make('super123')
        ]);
        $superAdmin->assignRole('Super Admin');

        // Creating Admin User
        $admin = User::create([
            'name' => 'Admin', 
            'email' => 'admin@maj.com',
            'password' => Hash::make('admin123')
        ]);
        $admin->assignRole('Admin');

        // Creating Product Manager User
        $productManager = User::create([
            'name' => 'Foreman', 
            'email' => 'foreman@maj.com',
            'password' => Hash::make('foreman1')
        ]);
        $productManager->assignRole('Product Manager');

        // Creating Application User
        $user = User::create([
            'name' => 'User', 
            'email' => 'user@maj.com',
            'password' => Hash::make('user1234')
        ]);
        $user->assignRole('User');
    }
}