<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permission::create(['name' => 'dashboard']);
        Permission::create(['name' => 'administrar-configuraciones']);
        Permission::create(['name' => 'subir-documentos']);
        Permission::create(['name' => 'ver-documentos']);

        Role::create(['name' => 'admin'])->givePermissionTo(Permission::all());
        //->givePermissionTo(['publish articles', 'unpublish articles']);
        
        User::factory()->create([
            'name' => 'Marta Orpi',
            'email' => 'marta@admin.com',
        ])->assignRole('admin');
    }
}
