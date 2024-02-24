<?php

namespace Database\Factories;

use App\Models\Bank;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agency>
 */
class AgencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'bank_name' => Bank::all()->random()->name,
            'name' => $this->faker->unique()->company,
            'number' => $this->faker->numerify('####'),
            'address' => $this->faker->address,
            'code' => $this->faker->numerify('###')
        ];
    }
}
