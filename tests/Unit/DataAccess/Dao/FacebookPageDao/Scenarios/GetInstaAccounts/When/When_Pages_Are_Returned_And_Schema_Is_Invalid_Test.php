<?php


namespace InstaFetcherTests\Unit\DataAccess\Dao\FacebookPageDao\Scenarios\GetInstaAccounts\When;


use InstaFetcher\DataAccess\Dtos\Serializers\Exception\FacebookPagesDtoDeserializationError;
use InstaFetcherTests\Unit\DataAccess\Dao\FacebookPageDao\Scenarios\GetInstaAccounts\Given_User_Tries_To_Fetch_All_Pages_And_Insta_Users;
use Mockery;
use Mockery\MockInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * @testdox Given The User Tries To Fetch All Pages And Insta Users, When Pages Are Returned And Schema Is Invalid Test (DataAccess/Dao)
 */
class When_Pages_Are_Returned_And_Schema_Is_Invalid_Test extends Given_User_Tries_To_Fetch_All_Pages_And_Insta_Users
{

    /**
     * @var ResponseInterface|MockInterface
     */
    protected $mockResponse;
    protected array $response=["response","fake"];

    public function setUpClassProperties()
    {
        $this->mockResponse = Mockery::mock(ResponseInterface::class);
        $this->mockHttpClient
            ->shouldReceive("request")
            ->andReturns($this->mockResponse);
        $this->mockResponse
            ->shouldReceive("getStatusCode")
            ->andReturns(200);
        $this->mockResponse
            ->shouldReceive("toArray")
            ->andReturns($this->response);;
        $this->mockPagesSerializer
            ->shouldReceive("deserialize")
            ->andThrows(new FacebookPagesDtoDeserializationError);
    }

    public function fixtureProvider(): array
    {
        $token = "1111";

        return [
            [
                "token"=>$token,
            ]
        ];
    }

    public function initFixture(array $data)
    {
        $this->token=$data["token"];
    }

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
    public function Then_Response_Code_Was_Retrieved_For_Validation()
    {
        $this->mockResponse
            ->shouldHaveReceived("getStatusCode")
            ->once();
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_The_Response_Body_Was_Retrieved()
    {
        $this->mockResponse
            ->shouldHaveReceived("toArray",[false]);
        $this->mockResponse
            ->shouldHaveReceived("toArray")
            ->once();
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_The_Pages_Were_Attempted_To_Be_Decoded()
    {
        $this->mockPagesSerializer
            ->shouldHaveReceived("deserialize",[$this->response]);
        $this->mockPagesSerializer
            ->shouldHaveReceived("deserialize")
            ->once();
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_Error_Was_Not_Attempted_To_Be_Decoded()
    {
        $this->mockErrorSerializer
            ->shouldNotHaveReceived("deserialize");
    }

    /**
     * @test
     */
    public function Then_Invalid_Schema_Error_Occurs()
    {
        self::assertInstanceOf(FacebookPagesDtoDeserializationError::class,$this->exception);
    }
}