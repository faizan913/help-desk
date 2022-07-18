<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PriorityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          factory(App\Priority::class )->create()->each(function($user) {

            

                $address = factory(App\Priority::class)->create([
                    'name' => $entity
                ]);

                $user->entities()->save($entity);
            });
        ];
    }
}
