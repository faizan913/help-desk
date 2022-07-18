<?php

namespace Database\Seeders;

use App\Models\Priority;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            Priority::PRIORITIES['PRIORITY_LOW'],
            Priority::PRIORITIES['PRIORITY_MEDIUM'],
            Priority::PRIORITIES['PRIORITY_HIGH'],
        ])->each(function ($priority) {
            Priority::create([
                'name' => $priority
            ]);
        });
    }
}
