<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Plan;
use Auth;

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
        view()->composer('*', function ($view) {
            if (Auth::check()) {
                // Retrieve the user's package only if they are authenticated
                $package = Plan::where('id', Auth::user()->package)->get(['plans.*']);
                $view->with('package', $package);
            }
        });

        //
    }
}
