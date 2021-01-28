<?php

namespace Database\Seeders;

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
//        \App\Models\User::factory(20)
//            ->hasDriver()
//            ->create();

        $role = Role::create(['name' => 'admin']);
        Permission::create(['name' => 'manage-users']);
        Permission::create(['name' => 'manage-races']);
        Permission::create(['name' => 'manage-f1-numbers']);
        Permission::create(['name' => 'manage-f1-teams']);
        Permission::create(['name' => 'manage-drivers']);
        Permission::create(['name' => 'manage-divisions']);
        Permission::create(['name' => 'manage-protests']);
        Permission::create(['name' => 'manage-tracks']);

        $permissions = Permission::all();

        $role->givePermissionTo($permissions);

        $user = \App\Models\User::factory()->create(['email' => 'admin@admin.com']);
        $user->assignRole($role);
    }
}
