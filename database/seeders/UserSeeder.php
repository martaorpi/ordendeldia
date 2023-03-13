<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{

    public function run()
    {
        Permission::create(['name' => 'administrar-usuarios']);

        Role::create(['name' => 'admin'])->givePermissionTo(Permission::all());;
        
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
        ])->assignRole('admin');
    }
}
