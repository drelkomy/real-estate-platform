<?php

namespace Tests\Feature;

use App\Models\User;
use App\Modules\Identity\Http\Livewire\Auth\Login;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class IdentityAndNavigationTest extends TestCase
{
    use DatabaseTransactions;

    public function test_home_page_renders_successfully_with_hero_and_cards(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('للبيع');
        $response->assertSee('للإيجار');
    }

    public function test_login_and_register_pages_render_for_guests(): void
    {
        $this->get('/login')->assertStatus(200)->assertSee('email');
        $this->get('/register')->assertStatus(200)->assertSee('email');
    }

    public function test_admin_user_can_login_via_livewire_component_and_redirects_to_admin(): void
    {
        $role = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $admin = User::factory()->create([
            'email' => 'admin_login_test@example.com',
            'password' => bcrypt('password123'),
            'is_active' => true,
        ]);
        $admin->assignRole('admin');

        Livewire::test(Login::class)
            ->set('email', 'admin_login_test@example.com')
            ->set('password', 'password123')
            ->call('login')
            ->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticatedAs($admin);
    }

    public function test_client_user_can_login_and_redirects_to_home(): void
    {
        $role = Role::firstOrCreate(['name' => 'client', 'guard_name' => 'web']);
        $client = User::factory()->create([
            'email' => 'client_login_test@example.com',
            'password' => bcrypt('password123'),
            'is_active' => true,
        ]);
        $client->assignRole('client');

        Livewire::test(Login::class)
            ->set('email', 'client_login_test@example.com')
            ->set('password', 'password123')
            ->call('login')
            ->assertRedirect(url('/'));

        $this->assertAuthenticatedAs($client);
    }

    public function test_unauthenticated_users_are_redirected_from_admin_area(): void
    {
        $this->get('/admin')->assertRedirect('/login');
        $this->get('/admin/users')->assertRedirect('/login');
        $this->get('/admin/roles')->assertRedirect('/login');
        $this->get('/admin/profile')->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access_admin_dashboard_and_modules(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@realestate.local'],
            ['name' => 'Admin User', 'password' => bcrypt('password'), 'is_active' => true]
        );

        $this->actingAs($admin);

        $this->get('/admin')->assertStatus(200)->assertSee('Dashboard');
        $this->get('/admin/users')->assertStatus(200)->assertSee('Users Management');
        $this->get('/admin/roles')->assertStatus(200)->assertSee('Roles & Permissions');
        $this->get('/admin/profile')->assertStatus(200)->assertSee('Account Settings');
    }
}
