<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CallTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_super_admin_can_visit_the_call_section(): void
    {
        $superAdminRole = factory(Role::class)
            ->create(['name' => 'Super Administrador'])
            ->id;

        $superAdmin = factory(User::class)
            ->create(['role_id' => $superAdminRole]);

        $this->actingAs($superAdmin)
            ->get(route('call.index'))
            ->assertSuccessful()
            ->assertSee('Seguimiento de llamadas');
    }

    /** @test */
    public function test_admins_can_visit_the_call_section(): void
    {
        $adminRole = factory(Role::class)
            ->create(['name' => 'Administrador'])
            ->id;

        $admin = factory(User::class)
            ->create(['role_id' => $adminRole]);

        $this->actingAs($admin)
            ->get(route('call.index'))
         // ->assertSuccessful()
            ->assertSee('Seguimiento de llamadas');
    }

    /** @test */
    public function test_assistants_can_visit_the_call_section(): void
    {
        $assistantRole = factory(Role::class)
            ->create([
                'name' => 'Asistente',
            ])->id;

        $assistant = factory(User::class)
            ->create([
                'role_id' => $assistantRole,
            ]);

        $this->actingAs($assistant)
            ->get(route('call.index'))
         // ->assertSuccessful()
            ->assertSee('Seguimiento de llamadas');
    }

    /** @test */
    public function test_sales_can_visit_the_call_section(): void
    {
        $salesRole = factory(Role::class)
            ->create([
                'name' => 'Ventas',
            ])
            ->id;

        $sales = factory(User::class)
            ->create([
                'role_id' => $salesRole,
            ]);

        $this->actingAs($sales)
            ->get(route('call.index'))
         // ->assertSuccessful()
            ->assertSee('Seguimiento de llamadas');
    }

    /** @test */
    public function test_interns_cannot_visit_the_call_section(): void
    {
        $internRole = factory(Role::class)
            ->create(['name' => 'Pasante'])
            ->id;

        $intern = factory(User::class)
            ->create(['role_id' => $internRole]);

        $this->actingAs($intern)
            ->get(route('call.index'))
            ->assertDontSeeText('Seguimiento de llamadas');
    }

    /** @test */
    public function test_client_cannot_visit_the_call_section(): void
    {
        $clientRole = factory(Role::class)
            ->create(['name' => 'Cliente'])
            ->id;

        $client = factory(User::class)
            ->create(['role_id' => $clientRole]);

        $this->actingAs($client)
            ->get(route('call.index'))
            ->assertDontSeeText('Seguimiento de llamadas');
    }
}
