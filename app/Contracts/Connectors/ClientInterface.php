<?php

namespace App\Contracts\Connectors;

use GuzzleHttp\Client as Guzzle;
use App\Libraries\Connectors\GuzzleResponse;

/**
 * Interface ClientInterface
 */
interface ClientInterface
{
    /**
     * @return Guzzle
     */
    public function guzzle(): Guzzle;

    /**
     * @return GuzzleResponse
     */
    public function guzzleResponse(): GuzzleResponse;

}
