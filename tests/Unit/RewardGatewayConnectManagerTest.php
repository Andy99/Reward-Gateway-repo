<?php

use \Mockery as m;
use Tests\TestCase;
use App\Contracts\Connectors\ClientInterface;
use GuzzleHttp\Client as Guzzle;
use App\Libraries\Connectors\GuzzleResponse;
use App\Libraries\Connectors\RewardGatewayConnectManager;
use Psr\Http\Message\ResponseInterface;

class RewardGatewayConnectManagerTest extends TestCase
{
    
    public function setUp(): void
    {
        parent::setup();
        $this->client = m::mock(ClientInterface::class);
        $this->guzzle = m::mock(Guzzle::class);
        $this->guzzleResponse = m::mock(GuzzleResponse::class);
        $this->responseInterface = m::mock(ResponseInterface::class);

        $this->manager = new RewardGatewayConnectManager($this->client);
    }

    /**
     * @test
     */
    public function it_should_test_get_url()
    {
        $url = config('rewardgateway.url');
        $r = $this->manager->getUrl();
        $this->assertEquals($url, $r);
    }

    /**
     * @test
     */
    public function it_should_test_get_header()
    {
        $username = config('rewardgateway.username');
        $password = config('rewardgateway.password');
        $auth = [
            'auth' => [
                $username,
                $password
            ]
        ];
        $r = $this->manager->getHeader();
        $this->assertEquals($auth, $r);
    }

    /**
     * @test
     */
    public function it_should_test_get_list()
    {
        $username = config('rewardgateway.username');
        $password = config('rewardgateway.password');
        $url = config('rewardgateway.url') . "/list";
        $auth = ['auth' => [$username, $password]];
        $mockResponse = 'mock response';
        $response = ['data' => 'success'];
        $this->client->shouldReceive('guzzle')
            ->once()
            ->andReturn($this->guzzle);

        $this->guzzle->shouldReceive('get')
            ->with($url, $auth)
            ->once()
            ->andReturn($mockResponse);

        $this->client->shouldReceive('guzzleResponse')
            ->once()
            ->andReturn($this->guzzleResponse);

        $this->guzzleResponse->shouldReceive('getResponse')
            ->with($mockResponse)
            ->andReturn($response);

        $r = $this->manager->list();
        $this->assertEquals($r, $response);
    }

    /**
     * @test
     *
     * @expectedException \Exception
     */
    public function it_should_throw_an_exception()
    {
        $username = config('rewardgateway.username');
        $password = config('rewardgateway.password');
        $url = config('rewardgateway.url') . "/list";
        $auth = ['auth' => [$username, $password]];
        $mockResponse = 'mock response';
        $response = ['data' => 'success'];
        $this->client->shouldReceive('guzzle')
            ->time(6)
            ->andReturn($this->guzzle);

        $this->guzzle->shouldReceive('get')
            ->with($url, $auth)
            ->once()
            ->andThrow(\Exception::class);

        $this->manager->list();
    }
}