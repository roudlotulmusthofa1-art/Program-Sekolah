<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // ROLE
        Role::firstOrCreate(['name' => 'super_admin']);
        Role::firstOrCreate(['name' => 'tu']);
        Role::firstOrCreate(['name' => 'bendahara']);
        Role::firstOrCreate(['name' => 'wali_kelas']);
        Role::firstOrCreate(['name' => 'guru']);
        Role::firstOrCreate(['name' => 'wali_santri']);

        // PERMISSION
        Permission::firstOrCreate(['name' => 'kelola user']);
        Permission::firstOrCreate(['name' => 'kelola pembayaran']);
        Permission::firstOrCreate(['name' => 'kelola absensi']);
        Permission::firstOrCreate(['name' => 'kelola nilai']);

        // ROLE SUPER ADMIN
        $superAdmin = Role::findByName('super_admin');

        $superAdmin->givePermissionTo([
            'kelola user',
            'kelola pembayaran',
            'kelola absensi',
            'kelola nilai'
        ]);
    }
}