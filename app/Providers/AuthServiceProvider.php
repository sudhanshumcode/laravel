<?php

namespace App\Providers;
use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
	         Passport::routes();
//Passport::personalAccessTokensExpireIn(Carbon::now()->addseconds(-1));
             Passport::tokensExpireIn(now()->addseconds(120));
             Passport::refreshTokensExpireIn(now()->addseconds(120));
             Passport::personalAccessTokensExpireIn(now()->addseconds(120));
   // Passport::	(__DIR__.'/../secrets/oauth');
        //
    }
}
