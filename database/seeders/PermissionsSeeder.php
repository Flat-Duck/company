<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list administrations']);
        Permission::create(['name' => 'view administrations']);
        Permission::create(['name' => 'create administrations']);
        Permission::create(['name' => 'update administrations']);
        Permission::create(['name' => 'delete administrations']);

        Permission::create(['name' => 'list attachments']);
        Permission::create(['name' => 'view attachments']);
        Permission::create(['name' => 'create attachments']);
        Permission::create(['name' => 'update attachments']);
        Permission::create(['name' => 'delete attachments']);

        Permission::create(['name' => 'list departments']);
        Permission::create(['name' => 'view departments']);
        Permission::create(['name' => 'create departments']);
        Permission::create(['name' => 'update departments']);
        Permission::create(['name' => 'delete departments']);

        Permission::create(['name' => 'list extoutboxes']);
        Permission::create(['name' => 'view extoutboxes']);
        Permission::create(['name' => 'create extoutboxes']);
        Permission::create(['name' => 'update extoutboxes']);
        Permission::create(['name' => 'delete extoutboxes']);

        Permission::create(['name' => 'list inboxes']);
        Permission::create(['name' => 'view inboxes']);
        Permission::create(['name' => 'create inboxes']);
        Permission::create(['name' => 'update inboxes']);
        Permission::create(['name' => 'delete inboxes']);

        Permission::create(['name' => 'list intoutboxes']);
        Permission::create(['name' => 'view intoutboxes']);
        Permission::create(['name' => 'create intoutboxes']);
        Permission::create(['name' => 'update intoutboxes']);
        Permission::create(['name' => 'delete intoutboxes']);

        Permission::create(['name' => 'list mainfolders']);
        Permission::create(['name' => 'view mainfolders']);
        Permission::create(['name' => 'create mainfolders']);
        Permission::create(['name' => 'update mainfolders']);
        Permission::create(['name' => 'delete mainfolders']);

        Permission::create(['name' => 'list memos']);
        Permission::create(['name' => 'view memos']);
        Permission::create(['name' => 'create memos']);
        Permission::create(['name' => 'update memos']);
        Permission::create(['name' => 'delete memos']);

        Permission::create(['name' => 'list offices']);
        Permission::create(['name' => 'view offices']);
        Permission::create(['name' => 'create offices']);
        Permission::create(['name' => 'update offices']);
        Permission::create(['name' => 'delete offices']);

        Permission::create(['name' => 'list subfolders']);
        Permission::create(['name' => 'view subfolders']);
        Permission::create(['name' => 'create subfolders']);
        Permission::create(['name' => 'update subfolders']);
        Permission::create(['name' => 'delete subfolders']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
