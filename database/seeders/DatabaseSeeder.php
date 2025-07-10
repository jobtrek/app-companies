<?php

namespace Database\Seeders;

use App\Models\Commentaire;
use App\Models\Convention;
use App\Models\Domain;
use App\Models\Entreprise;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Domain::firstOrCreate(
            ['id' => 1],
            ['name' => 'demo']
        );

        $domains = Domain::all();

        $entreprises = Entreprise::factory()->count(20)->create();

        Entreprise::where('id', 1)->delete();
        Entreprise::factory([
            'id' => 1,
            'name' => 'Centre de formation Jobtrek',
            'email' => 'jobtrek@jb.ch',
            'photo' => 'https://staging.jobtrek.ch/wp-content/uploads/2021/08/b%C3%A2timent-300x199.jpg',
            'description' => 'Jobtrek est une fondation suisse qui contribue à offrir un avenir et de l’espérance aux jeunes. Son offre complète se construit autour d’un lien fort avec les entreprises.',
            'website' => 'https://jobtrek.ch/',
            'phone_number' => '+41 24 426 14 14',
            'address' => 'Avenue des Découvertes 3. 1400 Yverdon-les-Bains',
            'domain_id' => Domain::inRandomOrder()->value('id') ?? 1,
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
