<?php

namespace App\Libraries\Connectors;

use App\Libraries\Connectors\GuzzleResponse;
use App\Contracts\Connectors\ClientInterface;
use App\Libraries\Connectors\ConnectAbstract;
use App\Contracts\Connectors\ConnectorInterface as Connector;
use App\Contracts\RewardGatewayConnectorInterface as RGConnectorInterface;

class RewardGatewayConnectManager extends ConnectAbstract implements RGConnectorInterface, Connector
{
    const RESOURCE = '/list';
    /**
     * RewardGatewayConnectManager constructor
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        parent::__construct($client);
    }

    /**
     * Get url
     *@return string
     */
    public function getUrl(): string
    {
        return config('rewardgateway.url');
    }

    /**
     * Get header
     * @return array
     */
    public function getHeader(): array
    {
        return ['auth' => [
                $this->getCredential()['username'],
                $this->getCredential()['password']
            ]
        ];
    }

    /**
     * Get list
     * @return array
     * @throws \Exception
     */
    public function list(): array
    {
        return $this->get($this->getUrl() . self::RESOURCE, $this->getHeader());
    }
}
