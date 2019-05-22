<?php

namespace RB28DETT\Profile;

use Illuminate\Support\ServiceProvider;

class ProfileServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/Translations', 'rb28dett_profile');

        if (!$this->app->routesAreCached()) {
            require __DIR__.'/Routes/web.php';
        }

        $this->publishes([
            __DIR__.'/Views/public' => resource_path('views/vendor/rb28dett_profile/public'),
        ], 'rb28dett_profile');

        $this->loadViewsFrom(__DIR__.'/Views', 'rb28dett_profile');
        //$this->loadViewsFrom(resource_path('views/vendor/RB28DETT/Profile'), 'rb28dett_profile_public');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
