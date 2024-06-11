<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrganizationWallet>
 */
class OrganizationWalletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            // 'organization_id' => \App\Models\Organization::factory(),
            // 'balance' => $this->faker->randomFloat(2, 0, 1000000),
        ];
    }
}
