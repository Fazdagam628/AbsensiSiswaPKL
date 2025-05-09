<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Dedoc\Scramble\Scramble;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Dedoc\Scramble\Support\Generator\SecurityScheme;
use Illuminate\Support\Facades\URL;

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
        Gate::define('viewPulse', function (User $user) {
            return $user->hasRole('super_admin');
        });
        Scramble::configure()
            ->routes(function (Route $route) {
                return Str::startsWith($route->uri, 'api/');
            });
        SecurityScheme::http('bearer');
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}