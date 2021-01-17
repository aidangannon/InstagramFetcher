<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DataAccess\Dao\FacebookPageDao\Scenarios\GetInstaAccounts\When;


use InstaFetcherTests\Unit\DataAccess\Dao\FacebookPageDao\Scenarios\GetInstaAccounts\Given_User_Tries_To_Fetch_All_Pages_And_Insta_Users;
use Mockery;
use Mockery\MockInterface;
use Symfony\Component\HttpClient\Exception\TransportException;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * @testdox Given The User Tries To Fetch All Pages And Insta Users, When The Api Is Offline (DataAccess/Dao)
 */
class When_Api_Is_Offline_Test extends Given_User_Tries_To_Fetch_All_Pages_And_Insta_Users
{
    /**
     * @var ResponseInterface|MockInterface
     */
    protected $mockResponse;

    public function setUpClassProperties()
    {
        $this->mockResponse = Mockery::mock(ResponseInterface::class);
        $this->mockHttpClient
            ->shouldReceive("request")
            ->andReturns($this->mockResponse);
        $this->mockResponse
            ->shouldReceive("getStatusCode")
            ->andThrow(TransportException::class);
    }

    public function fixtureProvider(): array { return [ [ ] ]; }

    public function initFixture(array $data) { }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_Api_Request_Was_Sent()
    {
        $this->mockHttpClient
            ->shouldHaveReceived(
                "request",
                [
                    'GET',
                    "{$this->baseUrl}me/accounts?".
                    "fields=instagram_business_account{username,followers_count}&".
                    "access_token={$this->token}&appsecret_proof=".hash_hmac('sha256', $this->token, $this->appSecret)
                ]
            );
        $this->mockHttpClient
            ->shouldHaveReceived("request")
            ->once();
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_Response_Code_Was_Attempted_To_Be_Retrieved()
    {
        $this->mockResponse
            ->shouldHaveReceived("getStatusCode")
            ->once();
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_The_Response_Body_Was_Not_Retrieved()
    {
        $this->mockResponse
            ->shouldNotHaveReceived("toArray");
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_The_Graph_Error_Was_Not_Decoded()
    {
        $this->mockErrorSerializer
            ->shouldNotHaveReceived("deserialize");
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_No_Pages_Were_Not_Decoded()
    {
        $this->mockPagesSerializer
            ->shouldNotHaveReceived("deserialize");
    }

    /**
     * @test
     */
    public function Then_Transport_Layer_Error_Occurs()
    {
        self::assertInstanceOf(TransportException::class,$this->exception);
    }
}