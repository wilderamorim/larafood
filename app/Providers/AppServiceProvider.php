<?php

namespace App\Providers;

use App\Observers\TenantObserver;
use App\Models\{Plan, Tenant};
use App\Observers\PlanObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //observes
        Plan::observe(PlanObserver::class);
        Tenant::observe(TenantObserver::class);
    }
}
