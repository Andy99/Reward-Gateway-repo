<?php

namespace App\Libraries\Connectors;

use App\Contracts\Connectors\ClientInterface;
use GuzzleHttp\Client as Guzzle;
use App\Libraries\Connectors\GuzzleResponse;

class Client implements ClientInterface
{
    /**
     * @var Client
     */
    private $guzzle;

    /**
     * @var GuzzleResponse
     */
    private $guzzleResponse;

    /**
     * Client constructor.
     * @param Guzzle $guzzle
     */
    public function __construct(Guzzle $guzzle, GuzzleResponse $guzzleResponse)
    {
        $this->guzzle = $guzzle;
        $this->guzzleResponse = $guzzleResponse;
    }

    /**
     * @return Client|Guzzle
     */
    public function guzzle(): Guzzle
    {
        return $this->guzzle;
    }

    /**
     * @return GuzzleResponse
     */
    public function guzzleResponse(): GuzzleResponse
    {
        return $this->guzzleResponse;
    }
}
