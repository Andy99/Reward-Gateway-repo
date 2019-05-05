<?php

namespace App\Repositories;

use App\Contracts\RewardGatewayInterface;
use App\Libraries\Connectors\RewardGatewayConnectManager;

class RewardGatewayRepository implements RewardGatewayInterface
{
    /**
     * RewardGatewayRepository constructor
     * @param RewardGatewayConnectManager $connector
     */
    public function __construct(RewardGatewayConnectManager $connector)
    {
        $this->connector = $connector;
    }

    /**
     * Get list
     * @return array
     */
    public function list(): array
    {
        return $this->connector->list();
    }
}