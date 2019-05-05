<?php

namespace App\Libraries\Connectors;

use App\Contracts\Connectors\ClientInterface;
use App\Exceptions\ConnectorException;

abstract class ConnectAbstract
{
    const NUM_OF_ATTEMPTS = 5;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * ConnectAbstract constructor
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Get credential
     * @return array
     */
    public function getCredential(): array
    {
        $username = config('rewardgateway.username');
        $password = config('rewardgateway.password');
        return [
            'username' => $username,
            'password' => $password
        ];
    }

    /**
     * Get
     * @param string $url
     * @param array $header
     * @return mixed
     * @throws \Exception
     */
    public function get(string $url, array $header): array
    {
        $attempts = 0;
        do {
            try {
                $response = $this->client->guzzle()->get($url, $header);
                return $this->client->guzzleResponse()->getResponse($response);
            } catch (\Exception $e) {
                $attempts++;
                sleep(1);
                continue;
            }
        } while ($attempts < self::NUM_OF_ATTEMPTS);

        throw new ConnectorException($e->getMessage(), $e->getCode(), $e);
    }

    abstract protected function getHeader();

    abstract protected function getUrl();
}