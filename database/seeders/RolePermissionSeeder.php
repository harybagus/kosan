<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cache
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // =========================================================
        // BUAT PERMISSIONS
        // =========================================================
        $permissions = [
            // Room
            'view_room',
            'create_room',
            'edit_room',
            'delete_room',

            // Tenant
            'view_tenant',
            'create_tenant',
            'edit_tenant',
            'delete_tenant',

            // Payment
            'view_payment',
            'create_payment',
            'edit_payment',
            'delete_payment',
            'mark_payment_paid',

            // Reports
            'view_reports',
            'export_reports',

            // Notifications
            'view_notifications',
            'manage_notifications',

            // Users
            'view_users',
            'create_users',
            'edit_users',
            'delete_users',

            // Facility
            'view_facility',
            'create_facility',
            'edit_facility',
            'delete_facility',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // =========================================================
        // BUAT ROLES
        // =========================================================

        // Super Admin — akses semua
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin']);
        $superAdmin->syncPermissions(Permission::all());

        // Admin — semua kecuali manage users
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions([
            'view_room',
            'create_room',
            'edit_room',
            'delete_room',
            'view_tenant',
            'create_tenant',
            'edit_tenant',
            'delete_tenant',
            'view_payment',
            'create_payment',
            'edit_payment',
            'delete_payment',
            'mark_payment_paid',
            'view_reports',
            'export_reports',
            'view_notifications',
            'manage_notifications',
            'view_facility',
            'create_facility',
            'edit_facility',
            'delete_facility',
        ]);

        // Staff — hanya view & operasional dasar
        $staff = Role::firstOrCreate(['name' => 'staff']);
        $staff->syncPermissions([
            'view_room',
            'view_tenant',
            'create_tenant',
            'edit_tenant',
            'view_payment',
            'create_payment',
            'mark_payment_paid',
            'view_reports',
            'view_notifications',
        ]);

        // =========================================================
        // ASSIGN ROLE KE USER YANG ADA
        // =========================================================
        $firstUser = User::first();
        if ($firstUser) {
            $firstUser->update(['role' => 'admin']);
            $firstUser->assignRole('super_admin');
            $this->command->info("✅ Role 'super_admin' diberikan ke: {$firstUser->email}");
        }

        $this->command->info('✅ Roles: ' . Role::count());
        $this->command->info('✅ Permissions: ' . Permission::count());
    }
}
