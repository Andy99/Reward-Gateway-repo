<?php

use \Mockery as m;
use Tests\TestCase;
use GuzzleHttp\Client as Guzzle;
use App\Libraries\Connectors\Client;
use App\Exceptions\ConnectorException;
use App\Libraries\Connectors\GuzzleResponse;
use App\Contracts\Connectors\ClientInterface;

class RewardGatewayControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setup();
        $this->guzzleMockCall = m::mock(Guzzle::class);
        $this->guzzleMockResponse = m::mock(GuzzleResponse::class);

        $this->app->instance(
            ClientInterface::class,
            new Client(
                $this->guzzleMockCall,
                $this->guzzleMockResponse
            )
        );
    }

    /**
     * @test
     */
    public function it_should_return_list_of_users()
    {
        $username = config('rewardgateway.username');
        $password = config('rewardgateway.password');
        $url = config('rewardgateway.url') . "/list";
        $auth = ['auth' => [$username, $password]];
        $mockResponse = 'mock response';
        $response = ['success' => true];
        $this->guzzleMockCall->shouldReceive('get')
            ->with($url, $auth)
            ->once()
            ->andReturn($mockResponse);

        $this->guzzleMockResponse->shouldReceive('getResponse')
            ->with($mockResponse)
            ->andReturn($response);

        $response = $this->get('api/list');
        $this->assertEquals(
            '{"data":{"success":true}}', $response->getContent()
        );
    }

    /**
     * @test
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
        $this->guzzleMockCall->shouldReceive('get')
            ->with($url, $auth)
            ->time(6)
            ->andReturn(\Exception::class);

        $r = $this->call('GET', '/list');
    }
}