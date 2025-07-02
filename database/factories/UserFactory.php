<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'lastname' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'roles' => fake()->randomElements([
                'admin',
                'formateur_informaticien',
                'formateur_commerce',
                'apprenti_informaticien',
                'apprenti_commerce',
                'coach',
            ], $count = 2),
            'password' => static::$password ??= Hash::make('password'),
            'entreprise_id' => \App\Models\Entreprise::factory(),
            'coach_id' => 1,
        ];
    }

    public function coach(): static
    {
        return $this->state(fn (array $attributes) => [
            'roles' => ['coach'],
        ]);
    }

    public function apprenti(): static
    {
        return $this->state(fn (array $attributes) => [
            'roles' => [fake()->randomElement(['apprenti_informaticien', 'apprenti_commerce'])],
        ]);
    }

    /**
     * Configure the factory to assign a coach to an apprentice.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (User $user) {
            $roles = is_array($user->roles) ? $user->roles : $user->roles->toArray();

            if (in_array('apprenti_informaticien', $roles) || in_array('apprenti_commerce', $roles)) {
                $coach = User::whereJsonContains('roles', 'coach')->inRandomOrder()->first();

                if ($coach) {
                    $user->coach()->associate($coach);
                    $user->save();
                }
            }
        });
    }
}
