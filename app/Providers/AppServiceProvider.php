<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
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
        \Carbon\Carbon::setLocale('pt_BR');

        Route::resourceVerbs([
            'create' => __('criar'),
            'edit' => __('editar'),
        ]);

        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
    }
}
