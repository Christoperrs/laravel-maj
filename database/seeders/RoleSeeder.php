<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $super = Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $productManager = Role::create(['name' => 'Product Manager']);
        $user = Role::create(['name' => 'User']);


        $super->givePermissionTo([
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
            'create-maintenance', 
            'edit-maintenance',   
            'delete-maintenance', 
            'view-maintenance', 
            'view-repair', 
            'approve-foreman',
            'approve-section'
        ]);
        $admin->givePermissionTo([
            'create-user',
            'edit-user',
            'delete-user',
            'create-product',
            'edit-product',
            'delete-product'
        ]);

        $productManager->givePermissionTo([
            'create-product',
            'edit-product',
            'delete-product',
            'view-repair', 
            'approve-foreman',
            'approve-section'

        ]);

        $user->givePermissionTo([
            'view-product'
        ]);
    }
}