<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Carbon\Carbon;
use Route;

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

        // Passport::routes();

        // 只开放 oauth/token
        Route::group(['middleware' => 'api'], function () {
            Passport::routes(function ($router) {
                return $router->forAccessTokens();
            });
        });

        Passport::tokensExpireIn(Carbon::now()->addHours(1));

        Passport::refreshTokensExpireIn(Carbon::now()->addHours(2));
    }
}
