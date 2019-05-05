<?php

namespace App\Contracts;

interface RewardGatewayConnectorInterface
{
    /**
     * Get url
     *@return string
     */
    public function getUrl(): string;

    /**
     * Get credential
     * @return array
     */
    public function getHeader(): array;

    /**
     * Get list
     * @return array
     * @throws \Exception
     */
    public function list(): array;

}