<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role = Role::create(['name' => 'admin']);
        Permission::create(['name' => 'manage-users']);
        Permission::create(['name' => 'manage-races']);
        Permission::create(['name' => 'manage-f1-numbers']);
        Permission::create(['name' => 'manage-f1-teams']);
        Permission::create(['name' => 'manage-drivers']);
        Permission::create(['name' => 'manage-divisions']);
        Permission::create(['name' => 'manage-protests']);
        Permission::create(['name' => 'manage-tracks']);
        Permission::create(['name' => 'manage-broadcasts']);
        Permission::create(['name' => 'view-admin']);

        $permissions = Permission::all();

        $role->givePermissionTo($permissions);

        $user = User::factory()->create(['email' => 'admin@admin.com']);
        $user->assignRole($role);

        User::factory()->count(10)->create();
    }
}
