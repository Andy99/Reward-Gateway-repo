<?php

namespace App\Providers;

use App\Contracts\RewardGatewayInterface;
use App\Repositories\RewardGatewayRepository;
use Illuminate\Support\ServiceProvider;
use App\Libraries\Connectors\RewardGatewayConnectManager;
use App\Contracts\Connectors\ClientInterface;
use Illuminate\Http\Request;

class RewardGatewayServiceProvider extends ServiceProvider
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
            RewardGatewayInterface::class,
            function ($app) {
                $connectorManager = new RewardGatewayConnectManager($app[ClientInterface::class], $app[Request::class]);
                return new RewardGatewayRepository($connectorManager);
            }
        );
    }
}
