<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commentaire>
 */
class CommentaireFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'description' => fake()->sentences(5, true),
            'apprentis_id' => User::whereJsonContains('roles', 'apprenti_informaticien')->orWhereJsonContains('roles', 'apprenti_commerce')->inRandomOrder()->first()->id,
            'coach_id' => User::whereJsonContains('roles', 'coach')->inRandomOrder()->first()->id,
        ];
    }
}
