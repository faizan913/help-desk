<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            User::ROLES['ROLE_ADMIN'], User::ROLES['ROLE_USER'],
            User::ROLES['ROLE_AGENT']
        ])->each(function ($roleName) {
            Role::create([
                'name' => $roleName
            ]);
        });
    }
}
