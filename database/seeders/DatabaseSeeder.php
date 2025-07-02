<?php

namespace Database\Seeders;

use App\Models\Entreprise;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $entreprises = Entreprise::factory()->count(5)->create();

        User::factory()
            ->count(15)
            ->coach()
            ->create()
            ->each(function ($user) use ($entreprises) {
                $user->entreprise_id = $entreprises->random()->id;
                $user->save();
            });

        User::factory()
            ->count(20)
            ->apprenti()
            ->create()
            ->each(function ($user) use ($entreprises) {
                $user->entreprise_id = $entreprises->random()->id;
                $user->save();
            });
    }
}
