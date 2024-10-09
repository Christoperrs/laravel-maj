<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create-role',
            'edit-role',
            'delete-role',
            'create-user',
            'edit-user',
            'delete-user',
            'view-product',
            'create-product',
            'edit-product',
            'delete-product',
            'create-part',
            'edit-part',
            'delete-part',
            'view-part',
            'create-maintenance', // Tambahkan permission untuk create maintenance
            'edit-maintenance',   // Tambahkan permission untuk edit maintenance
            'delete-maintenance', // Tambahkan permission untuk delete maintenance
            'view-maintenance',    // Tambahkan permission untuk view maintenance
        ];

        // Looping and Inserting Array's Permissions into Permission Table
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
