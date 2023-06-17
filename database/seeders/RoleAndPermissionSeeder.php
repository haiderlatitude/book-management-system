<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $editor = Role::create(['name' => 'editor']);
        $viewer = Role::create(['name' => 'viewer']);

        $adminPermissions = ['access', 'view book', 'add book', 'update book', 'delete book'];
        $editorPermissions = ['add book', 'update book', 'delete book'];
        
        foreach($adminPermissions as $permission){
            Permission::create(['name' => $permission]);
        }
        
        $adminRole->syncPermissions($adminPermissions);
        $editor->syncPermissions($editorPermissions);
        
        $admin = User::where('name', 'admin')->first();
        $admin->assignRole('admin');
    }
}
