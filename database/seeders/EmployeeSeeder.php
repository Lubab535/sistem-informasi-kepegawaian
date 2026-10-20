<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = [
            ['department' => 'Teknologi Informasi', 'name' => 'Andi Saputra', 'position' => 'Backend Developer', 'salary' => 8000000, 'joined_at' => '2022-03-01'],
            ['department' => 'Teknologi Informasi', 'name' => 'Budi Santoso', 'position' => 'Frontend Developer', 'salary' => 7500000, 'joined_at' => '2023-01-15'],
            ['department' => 'Sumber Daya Manusia', 'name' => 'Citra Lestari', 'position' => 'HR Specialist', 'salary' => 6500000, 'joined_at' => '2021-07-10'],
            ['department' => 'Keuangan', 'name' => 'Dian Permata', 'position' => 'Akuntan', 'salary' => 7000000, 'joined_at' => '2020-11-20'],
            ['department' => 'Sumber Daya Manusia', 'name' => 'Eko Prasetyo', 'position' => 'Recruiter', 'salary' => 6000000, 'joined_at' => '2024-02-05'],
        ];

        foreach ($employees as $employee) {
            $department = Department::where('name', $employee['department'])->firstOrFail();

            Employee::updateOrCreate(
                ['name' => $employee['name']],
                [
                    'department_id' => $department->id,
                    'position' => $employee['position'],
                    'salary' => $employee['salary'],
                    'joined_at' => $employee['joined_at'],
                ],
            );
        }
    }
}
