<?php

namespace Database\Factories;

use App\Models\Agency;
use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
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
            'person_cpf' => Person::all()->random()->cpf,
            'agency_name' => Agency::all()->random()->name,
            'type' => $this->faker->randomElement(['Checking', 'Saving', 'Salary', 'Joint', 'Financial Investments', 'Payment']),
            'number' => $this->faker->unique()->numerify('################'),
            'holder' => $this->faker->name,
            'opening_balance' => $this->faker->randomFloat(2, 0, 10000),
            'opening_date' => $this->faker->date
        ];
    }
}
