<?php

namespace App\Providers;

use App\Models\User;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use StudentAffairsUwm\Shibboleth\Entitlement;
use App\TeamSuperAdmin;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

//        Passport::routes(function ($router) {
//            $router->forAccessTokens();
//            $router->forPersonalAccessTokens();
//            $router->forTransientTokens();
//        });
//
//        Passport::tokensExpireIn(now()->addMinutes(60));
//        Passport::refreshTokensExpireIn(now()->addDays(1));
//        Passport::withCookieSerialization();

        Gate::define('is-admin', function (User $user) {
            return $user->hasRole('admin');
        });
    }
}
