<?php

namespace Database\Factories;

use App\Models\Entreprise;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ConventionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $today = Carbon::today();

        return [
            'date_de_départ' => $today->format('Y-m-d'),
            'date_de_retour' => $today->addDays(fake()->numberBetween(1, 30))->format('Y-m-d'),
            'users_id' => User::whereJsonContains('roles', 'apprenti_informaticien')->orWhereJsonContains('roles', 'apprenti_commerce')->inRandomOrder()->first()->id,
            'entreprise_id' => Entreprise::all()->random()->id,
        ];
    }
}
