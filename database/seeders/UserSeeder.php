<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Department;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $department = Department::pluck('id');
        $user = User::factory()->create([
            'name' => 'Agent1',
            'email' => 'agent1@respl.com',
            'password' => '$2y$10$UnLIBQB1uZZC1r5msFWTPuZCZsMBUpZINpJ48G5FmMxz6yVGP83rO',
            'department_id' => $department[0]
        ]);
        $user->assignRole(User::ROLES['ROLE_AGENT']);

        $user = User::factory()->create([
            'name' => 'Agent2',
            'email' => 'agent2@respl.com',
            'password' => '$2y$10$UnLIBQB1uZZC1r5msFWTPuZCZsMBUpZINpJ48G5FmMxz6yVGP83rO',
            'department_id' => $department[0]
        ]);
        $user->assignRole(User::ROLES['ROLE_AGENT']);


        $user = User::factory()->create([
            'name' => 'Agent3',
            'email' => 'agent3@respl.com',
            'password' => '$2y$10$UnLIBQB1uZZC1r5msFWTPuZCZsMBUpZINpJ48G5FmMxz6yVGP83rO',
            'department_id' => $department[0]
        ]);
        $user->assignRole(User::ROLES['ROLE_AGENT']);

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$UnLIBQB1uZZC1r5msFWTPuZCZsMBUpZINpJ48G5FmMxz6yVGP83rO',
            'department_id' => $department[3]
        ]);
        $user->assignRole(User::ROLES['ROLE_ADMIN']);

        $user = User::factory()->create([
            'name' => 'User1',
            'email' => 'user1@gamil.com',
            'password' => '$2y$10$UnLIBQB1uZZC1r5msFWTPuZCZsMBUpZINpJ48G5FmMxz6yVGP83rO',
            'department_id' => $department[1]
        ]);
        $user->assignRole(User::ROLES['ROLE_USER']);
        $user = User::factory()->create([
            'name' => 'User2',
            'email' => 'user2@gmail.com',
            'password' => '$2y$10$UnLIBQB1uZZC1r5msFWTPuZCZsMBUpZINpJ48G5FmMxz6yVGP83rO',
            'department_id' => $department[2]
        ]);
        $user->assignRole(User::ROLES['ROLE_USER']);
    }
}
