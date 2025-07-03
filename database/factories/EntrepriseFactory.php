<?php

namespace Database\Factories;

use App\Models\Domain;
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
            'description' => $this->faker->sentence(),
            'website' => $this->faker->url(),
            'phone_number' => $this->faker->phoneNumber(),
            'photo' => 'logo',
            'address' => $this->faker->address(),
            'domain_id' => Domain::inRandomOrder()->first()?->id ?? Domain::factory(),
        ];
    }
}
