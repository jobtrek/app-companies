<?php

namespace Database\Seeders;

use App\Models\Commentaire;
use App\Models\Domain;
use App\Models\Entreprise;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        $domains = Domain::factory()->count(2)->create();

        $entreprises = Entreprise::factory()->count(5)->create();

        Entreprise::where('id', 1)->delete();
        Entreprise::factory([
            'id' => 1,
            'name' => 'Centre de formation Jobtrek',
            'email' => 'jobtrek@jb.ch',
            'photo' => 'qwe',
            'description' => 'qweqweqweqwe',
            'website' => 'https://en.wikipedia.org/wiki/Wiki',
            'phone_number' => '0123456789',
            'address' => 'example street',
            'domain_id' => $domains->random()->id,
        ])->create();
        User::factory()
            ->count(10)
            ->coach()
            ->create();

        User::factory()
            ->count(40)
            ->apprenti()
            ->create();

        User::factory()
            ->count(10)
            ->formateur()
            ->create();

        Commentaire::factory()
            ->count(50)
            ->create();
    }
}
