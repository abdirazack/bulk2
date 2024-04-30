<?php

namespace Database\Factories;

use App\Models\Organization;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrganizationUser>
 */
class OrganizationUserFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'organization_id' => Organization::factory(),
            'email' => $this->faker->unique()->safeEmail,
            'username' => $this->faker->userName,
            'password' => static::$password ??= Hash::make('password'),
        ];
    }
}
