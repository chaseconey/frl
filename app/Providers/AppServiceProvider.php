<?php

namespace App\Providers;

use App\Service\Discord\Client;
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
        $this->app->singleton(Client::class, function ($app) {
            $token = config('services.discord.token');
            $baseUrl = 'https://discord.com/api';

            return Client::baseUrl($baseUrl)
                ->withHeaders([
                    'Authorization' => "Bot {$token}",
                ]);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
