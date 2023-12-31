<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=book>
 */
class bookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name'=>$this->faker->word(),
            'author'=>$this->faker->numberBetween(1,20),
            'category'=>$this->faker->numberBetween(1,20),
            'image'=>$this->faker->word(6),
            'description'=>$this->faker->word(20),
        ];
    }
}
