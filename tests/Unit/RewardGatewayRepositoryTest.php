<?php

use \Mockery as m;
use Tests\TestCase;
use App\Repositories\RewardGatewayRepository;
use App\Libraries\Connectors\RewardGatewayConnectManager;

class RewardGatewayRepositoryTest extends TestCase
{
    public function setUp(): void
    {
        $this->connector = m::mock(RewardGatewayConnectManager::class);
        $this->repository = new RewardGatewayRepository($this->connector);
    }

    /**
     * @test
     */
    public function it_should_test_get_list()
    {
        $data = ['data' => 'success'];
        $this->connector->shouldReceive('list')
            ->once()
            ->andReturn($data);

        $r = $this->repository->list();
        $this->assertEquals($r, $data);
    }
}