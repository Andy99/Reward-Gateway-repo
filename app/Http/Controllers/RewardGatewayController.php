<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Contracts\RewardGatewayInterface;

class RewardGatewayController extends Controller
{
    /**
     * The RewardGatewayRepository - Bound to Contract
     * @var \App\Contracts\RewardGatewayInterface $repository
     */
    protected $repository;

    /**
     * Create a new controller instance.
     * @param RewardGatewayInterface $repository
     * @return void
     */
    public function __construct(RewardGatewayInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get list
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function list(): JsonResponse
    {
        return response()->json(['data' => $this->repository->list()]);
    }
}
