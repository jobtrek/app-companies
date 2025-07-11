<?php

namespace App\Providers;

use App\Models\User;
use GMP;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('admin', function ($user) {
            return $user->roles->contains('admin');
        });

        Gate::define('formateur_commerce', function ($user) {
            return $user->roles->contains('formateur_commerce');
        });

        Gate::define('formateur_informaticien', function ($user) {
            return $user->roles->contains('formateur_informaticien');
        });

        Gate::define('coach', function ($user) {
            return $user->roles->contains('coach');
        });

        Gate::define('check_domains_apprenti_formateur', function ($user_to_check, $user_checker ) {
            if(!$user_to_check->roles->contains('formateur_commerce') && !$user_to_check->roles->contains('formateur_informaticien')) {
                return false;
            }
            return $user_checker->domain_id === $user_to_check->domain_id;
        });

        Gate::define('formateurs', function ($user) {
            return $user->roles->contains('formateur_commerce') ||  $user->roles->contains('formateur_informaticien');
        });
        Gate::define('manage-comment', function ($user, User $apprenti) {
            return $user->roles->contains('coach') && $apprenti->coach_id === $user->id;
        });

}}
