<?php

namespace App\Libraries\Connectors;

use Psr\Http\Message\ResponseInterface;

/**
 * Class GuzzleResponse
 * @package App\Libraries\Guzzle
 */
class GuzzleResponse
{
    /**
     * @param ResponseInterface $response
     * @return mixed
     */
    public function getResponse($response)
    {
        return \GuzzleHttp\json_decode($response->getBody()->getContents());
    }
}
