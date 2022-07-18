<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        collect([
            Status::STATUS_OPEN, Status::STATUS_CLOSED,
        ])->each(function ($status) {
            Status::create([
                'name' => $status
            ]);
        });
    }
}
