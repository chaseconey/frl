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
        $permission = Permission::create(['name' => 'manage-users']);

        $role->givePermissionTo($permission);

        $user = \App\Models\User::factory()->create(['email' => 'admin@admin.com']);
        $user->assignRole($role);
    }
}
