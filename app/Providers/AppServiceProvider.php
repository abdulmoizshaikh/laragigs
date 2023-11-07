<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
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
        // if we do this Model::unguard(); what we're saying is that we we're allowing the mass assignment and we no longer need to require you to add or us to add this fillable here so even though i don't have the fillable i should still i should be able to post another gig
        Model::unguard();
    }
}
