<?php

namespace Database\Factories;

use App\Models\Entreprise;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntrepriseFactory extends Factory
{
    protected $model = Entreprise::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'email' => $this->faker->unique()->companyEmail(),
            'role' => json_encode(['informaticien', 'employe_de_com']),
            'description' => $this->faker->sentence(),
            'website' => $this->faker->url(),
            'phone_number' => $this->faker->phoneNumber(),
            'photo' => null,
            'domain_id' => 1,
        ];
    }
}
