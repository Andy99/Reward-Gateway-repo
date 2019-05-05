<?php

namespace App\Contracts;

interface RewardGatewayInterface
{
    /**
     * Get credential
     * @return array
     */
    public function list(): array;
}