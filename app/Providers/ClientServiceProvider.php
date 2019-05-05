<?php

namespace App\Providers;

use App\Contracts\Connectors\ClientInterface;
use App\Libraries\Connectors\Client;
use App\Libraries\Connectors\GuzzleResponse;
use GuzzleHttp\Client as Guzzle;
use Illuminate\Support\ServiceProvider;

class ClientServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ClientInterface::class,
            function ($app) {
                return new Client($app[Guzzle::class], $app[GuzzleResponse::class]);
            }
        );
    }
}
