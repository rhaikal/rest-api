<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
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
        Http::macro('myAPI', function () {
            return Http::withBasicAuth('ricko@gmail.com', '12345')
            ->withOptions([
                'query' => ['apikey' => '1uAxqBhS7iG1v6ma2FWu2MjzHNUdDkM1QZ7DgbEn9LzuVOmM46Mkdoz6IUcQ1wpiU4cgbjMRiFCqQnXq']
            ])
            ->baseUrl('http://rest-server.test/api');
        });
    }
}
