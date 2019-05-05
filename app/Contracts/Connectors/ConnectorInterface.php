<?php

namespace App\Contracts\Connectors;

/**
 * Interface ConnectorInterface
 */
interface ConnectorInterface
{

    /**
     * Get credential
     * @return array
     */
    public function getCredential(): array;

    /**
     * Get
     * @param string $url
     * @param array $header
     * @return mixed
     * @throws \Exception
     */
    public function get(string $url, array $header): array;
}
