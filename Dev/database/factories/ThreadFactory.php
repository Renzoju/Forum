<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ThreadFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
        ];
    }
}
