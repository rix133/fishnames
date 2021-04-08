<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class UpdateUserRoleTest extends TestCase
{
    
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_add_new_role_to_user()
    {
        $this->actingAs($user = User::factory()->create());
        var_dump($user->toArray());

        $role = Role::factory()->create();
        var_dump($role->toArray());
        assertEquals(0, $user->roles->count());
    
        $response = $this->put('users/'.$user->id.'/update', [
            'roles'=>[$role->id]
        ]);  
        $response->assertStatus(200);
        assertEquals(1, $user->roles->count());
        assertEquals($role->title, $user->roles->first()->title);


    }
}
