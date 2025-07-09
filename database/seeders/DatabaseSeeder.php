<?php

namespace Database\Seeders;

use App\Models\Commentaire;
use App\Models\Convention;
use App\Models\Domain;
use App\Models\Entreprise;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        Domain::factory([
            'name' => 'Informatique'
        ])->create();

        Domain::factory([
            'name' => 'Employé de commerce'
        ])->create();

        $entreprises = Entreprise::factory()->count(20)->create();

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
            'domain_id' => Domain::inRandomOrder()->first()->id,
        ])->create();

        User::factory()
            ->count(10)
            ->coach()
            ->create();

        User::factory()
            ->count(500)
            ->apprenti()
            ->create();

        User::factory()
            ->count(10)
            ->formateur()
            ->create();

        User::factory([
            'name' => 'admin',
            'lastname' => 'adminovich',
            'email' => 'admin@test.com',
            'roles' => ["admin"],
            'password' => '$2y$12$xV6j8avLVM3C6BN8Em4Z.Ozz0Zxt750EbYVQ8JGxkFcgUAgLe6yva',
            'domain_id' => 1,
            'entreprise_id' => 1,
        ])->create();

        User::factory([
            'name' => 'coach',
            'lastname' => 'coaches',
            'email' => 'coach@test.com',
            'roles' => ["coach"],
            'password' => '$2y$12$xV6j8avLVM3C6BN8Em4Z.Ozz0Zxt750EbYVQ8JGxkFcgUAgLe6yva',
            'domain_id' => 1,
            'entreprise_id' => 1,
        ])->create();

        User::factory([
            'name' => 'formateur',
            'lastname' => 'formateurovich',
            'email' => 'form@test.com',
            'roles' => ["formateur_informaticien"],
            'password' => '$2y$12$xV6j8avLVM3C6BN8Em4Z.Ozz0Zxt750EbYVQ8JGxkFcgUAgLe6yva',
            'domain_id' => 1,
            'entreprise_id' => 1,
        ])->create();

        Commentaire::factory()
            ->count(50)
            ->create();

        Convention::factory()
            ->count(80)
            ->create();
    }
}
