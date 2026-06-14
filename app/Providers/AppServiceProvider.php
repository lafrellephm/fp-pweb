<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use App\Models\OutgoingLetter;
use App\Observers\OutgoingLetterObserver;

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
        \Illuminate\Pagination\Paginator::useBootstrapFive();

        Password::defaults(function () {
            return Password::min(1);
        });

        OutgoingLetter::observe(OutgoingLetterObserver::class);
    }
}
