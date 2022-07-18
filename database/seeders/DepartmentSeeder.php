<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            Department::DEPARTMENTS['TST_DEPARTMENTS'],
            Department::DEPARTMENTS['FINANCE_DEPARTMENTS'],
            Department::DEPARTMENTS['PHP_DEPARTMENTS'],
            Department::DEPARTMENTS['ADMIN_DEPARTMENTS'],
        ])->each(function ($priority) {
            Department::create([
                'name' => $priority
            ]);
        });
    }
}
