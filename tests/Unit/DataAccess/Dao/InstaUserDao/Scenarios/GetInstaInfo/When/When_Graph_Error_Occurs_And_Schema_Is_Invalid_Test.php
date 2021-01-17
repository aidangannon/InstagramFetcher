<?php


namespace InstaFetcherTests\Unit\DataAccess\Dao\InstaUserDao\Scenarios\GetInstaInfo\When;


use InstaFetcher\DataAccess\Dtos\Serializers\Exception\ErrorDtoDeserializationError;
use InstaFetcherTests\Unit\DataAccess\Dao\InstaUserDao\Scenarios\GetInstaInfo\Given_User_Tries_To_Fetch_Insta_User_Info;
use Mockery;
use Mockery\MockInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * @testdox Given User Tries To Fetch Insta User Info, When Graph Error Occurs And Schema Is Invalid Test (DataAccess/Dao)
 */
class When_Graph_Error_Occurs_And_Schema_Is_Invalid_Test extends Given_User_Tries_To_Fetch_Insta_User_Info
{

    /**
     * @var ResponseInterface|MockInterface
     */
    protected $mockResponse;
    protected array $response=["fake"=>"response"];

    private int $statusCode;

    public function setUpClassProperties()
    {
        $this->mockResponse = Mockery::mock(ResponseInterface::class);
        $this->mockResponse
            ->shouldReceive("getStatusCode")
            ->andReturns($this->statusCode);
        $this->mockHttpClient
            ->shouldReceive("request")
            ->andReturns($this->mockResponse);
        $this->mockResponse
            ->shouldReceive("toArray")
            ->andReturns($this->response);
        $this->mockErrorSerializer
            ->shouldReceive("deserialize")
            ->andThrows(new ErrorDtoDeserializationError);
    }

    public function fixtureProvider(): array
    {
        return [
            [
                "statusCode"=>400,
            ],
            [
                "statusCode"=>404,
            ],
            [
                "statusCode"=>401,
            ],
            [
                "statusCode"=>403,
            ],
            [
                "statusCode"=>500,
            ]
        ];
    }

    public function initFixture(array $data)
    {
        $this->statusCode=$data["statusCode"];
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
    public function Then_The_Graph_Error_Was_Attempted_To_Be_Decoded()
    {
        $this->mockErrorSerializer
            ->shouldHaveReceived("deserialize",[$this->response]);
        $this->mockErrorSerializer
            ->shouldHaveReceived("deserialize")
            ->once();
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_User_Was_Not_Decoded()
    {
        $this->mockUserSerializer
            ->shouldNotHaveReceived("deserialize");
    }

    /**
     * @test
     */
    public function Then_Invalid_Schema_Error_Occurs()
    {
        self::assertInstanceOf(ErrorDtoDeserializationError::class,$this->exception);
    }
}