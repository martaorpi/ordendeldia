<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;


use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_users_list_without_logged_in()
    {
        $response = $this->get('admin/user');
        $response->assertStatus(302);
    }

    public function test_get_users_list_with_logged_in()
    {
        $this->user = User::factory()->create();
        Auth::guard(config('backpack.base.guard'))->login($this->user);

        $response = $this->get('admin/user');
        $response->assertStatus(200);
    }

    public function test_create_a_user()
    {
        //Role::create(['name' => 'Admin'])->givePermissionTo(Permission::all());
        $this->user = User::factory()->create();
        //$this->user->assignRole('Admin');

        Auth::guard(config('backpack.base.guard'))->login($this->user);


        $post = User::factory()->create();

        $response = $this->post('admin/user', [
            "name" => "pepito",
            "email " => "pepito@gmail.com",
            "password" => "pepito",
        ]);

        $response->assertStatus(200);
    }

}
