<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DepartmentEmployeeViewsTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_the_login_page(): void
    {
        $this->get('/login')
            ->assertOk()
            ->assertSee('Login')
            ->assertDontSee('userDropdown');
    }

    public function test_database_seeder_is_repeatable_and_seeded_account_can_log_in(): void
    {
        $this->seed(DatabaseSeeder::class);
        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseCount('departments', 3);
        $this->assertDatabaseCount('employees', 5);

        $this->post(route('login'), [
            'email' => 'admin@perusahaan.com',
            'password' => 'password123',
        ])->assertRedirect(route('departments.index'));

        $this->assertAuthenticatedAs(User::where('email', 'admin@perusahaan.com')->firstOrFail());
    }

    public function test_application_layout_uses_hrd_branding_and_department_navigation(): void
    {
        $this->actingAs(User::factory()->create());

        $this->get(route('departments.index'))
            ->assertOk()
            ->assertSee('<title>Departemen - Sistem Informasi Kepegawaian</title>', false)
            ->assertSee('HRD')
            ->assertDontSee('Berita');
    }

    public function test_department_pages_render_and_department_can_be_created(): void
    {
        $this->actingAs(User::factory()->create());

        $department = Department::create(['name' => 'Teknologi Informasi']);

        $this->get(route('departments.index'))
            ->assertOk()
            ->assertSee('Daftar Departemen')
            ->assertSee('Teknologi Informasi');

        $this->get(route('departments.create'))
            ->assertOk()
            ->assertSee('Tambah Departemen');

        $this->get(route('departments.edit', $department))
            ->assertOk()
            ->assertSee('value="Teknologi Informasi"', false);

        $this->post(route('departments.store'), ['name' => 'Keuangan'])
            ->assertRedirect(route('departments.index'));

        $this->assertDatabaseHas('departments', ['name' => 'Keuangan']);
    }

    public function test_employee_pages_render_and_employee_can_be_created(): void
    {
        $this->actingAs(User::factory()->create());

        $department = Department::create(['name' => 'Sumber Daya Manusia']);
        $employee = Employee::create([
            'department_id' => $department->id,
            'name' => 'Budi Santoso',
            'position' => 'Analis SDM',
            'salary' => 5000000,
            'joined_at' => '2025-01-15',
        ]);

        $this->get(route('employees.index'))
            ->assertOk()
            ->assertSee('Daftar Pegawai')
            ->assertSee('Budi Santoso')
            ->assertSee('Sumber Daya Manusia');

        $this->get(route('employees.create'))
            ->assertOk()
            ->assertSee('Tambah Pegawai')
            ->assertSee('Pilih departemen');

        $this->get(route('employees.edit', $employee))
            ->assertOk()
            ->assertSee('value="2025-01-15"', false);

        $this->post(route('employees.store'), [
            'department_id' => $department->id,
            'name' => 'Siti Aminah',
            'position' => 'Staf SDM',
            'salary' => 4500000,
            'joined_at' => '2026-02-01',
        ])->assertRedirect(route('employees.index'));

        $this->assertDatabaseHas('employees', ['name' => 'Siti Aminah']);
    }
}
