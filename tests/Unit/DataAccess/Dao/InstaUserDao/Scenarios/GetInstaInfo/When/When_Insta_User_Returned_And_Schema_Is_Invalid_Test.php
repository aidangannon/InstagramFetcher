<?php


namespace InstaFetcherTests\Unit\DataAccess\Dao\InstaUserDao\Scenarios\GetInstaInfo\When;

use InstaFetcher\DataAccess\Dtos\Serializers\Exception\InstaUserDtoDeserializationError;
use InstaFetcherTests\Unit\DataAccess\Dao\InstaUserDao\Scenarios\GetInstaInfo\Given_User_Tries_To_Fetch_Insta_User_Info;
use Mockery;
use Mockery\MockInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * @testdox Given User Tries To Fetch Insta User Info, When Insta User Returned And Schema Is Invalid (DataAccess/Dao)
 */
class When_Insta_User_Returned_And_Schema_Is_Invalid_Test extends Given_User_Tries_To_Fetch_Insta_User_Info
{

    /**
     * @var ResponseInterface|MockInterface
     */
    protected $mockResponse;
    protected array $response=["fake"=>"response"];

    public function setUpClassProperties()
    {
        $this->mockResponse = Mockery::mock(ResponseInterface::class);
        $this->mockResponse
            ->shouldReceive("getStatusCode")
            ->andThrows(200);
        $this->mockHttpClient
            ->shouldReceive("request")
            ->andReturns($this->mockResponse);
        $this->mockResponse
            ->shouldReceive("toArray")
            ->andReturns($this->response);
        $this->mockUserSerializer
            ->shouldReceive("deserialize")
            ->andThrows(new InstaUserDtoDeserializationError);
    }

    public function fixtureProvider(): array
    {
        //TODO: does nothing
        return [ ];
    }

    public function initFixture(array $data)
    {
        //TODO: does nothing
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
                    "{$this->baseUrl}{$this->id}?".
                    "fields=id,username,followers_count&".
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
    public function Then_The_User_Was_Attempted_To_Be_Decoded()
    {
        $this->mockUserSerializer
            ->shouldHaveReceived("deserialize",[$this->response]);
        $this->mockUserSerializer
            ->shouldHaveReceived("deserialize")
            ->once();
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_Error_Was_Not_Decoded()
    {
        $this->mockErrorSerializer
            ->shouldNotHaveReceived("deserialize");
    }

    /**
     * @test
     */
    public function Then_Invalid_Schema_Error_Occurs()
    {
        self::assertInstanceOf(InstaUserDtoDeserializationError::class,$this->exception);
    }
}