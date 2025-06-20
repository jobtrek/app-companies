<?php

namespace Database\Seeders;

use App\Models\Apprenti;
use App\Models\Coach;
use App\Models\Formateur;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Apprenti::factory(50)->create();
        Formateur::factory(10)->create();
        Coach::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);
    }
}
