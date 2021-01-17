<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DataAccess\Dao\FacebookPageDao\Scenarios\GetInstaAccounts\When;


use InstaFetcher\DataAccess\Dtos\ErrorDto;
use InstaFetcher\DataAccess\Dtos\ErrorMetaDataDto;
use InstaFetcher\DataAccess\Http\Exception\GraphExceptions\Exceptions\GraphException;
use InstaFetcherTests\Unit\DataAccess\Dao\FacebookPageDao\Scenarios\GetInstaAccounts\Given_User_Tries_To_Fetch_All_Pages_And_Insta_Users;
use Mockery;
use Mockery\MockInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * @testdox Given The User Tries To Fetch All Pages And Insta Users, When The Graph Error Occurs (DataAccess/Dao)
 */
class When_GraphError_Occurs_Test extends Given_User_Tries_To_Fetch_All_Pages_And_Insta_Users
{
    /**
     * @var ResponseInterface|MockInterface
     */
    protected $mockResponse;
    protected array $response=["response","fake"];

    private ErrorDto $graphError;
    private int $statusCode;

    public function setUpClassProperties()
    {
        $this->mockResponse = Mockery::mock(ResponseInterface::class);
        $this->mockHttpClient
            ->shouldReceive("request")
            ->andReturns($this->mockResponse);
        $this->mockResponse
            ->shouldReceive("getStatusCode")
            ->andReturns($this->statusCode);
        $this->mockResponse
            ->shouldReceive("toArray")
            ->andReturns($this->response);;
        $this->mockErrorSerializer
            ->shouldReceive("deserialize")
            ->andReturns($this->graphError);
    }

    public function fixtureProvider(): array
    {

        $error = new ErrorDto(new ErrorMetaDataDto("BlahBlah",3213,"random message",321321));

        return [
            [
                "token"=>"1111",
                "statusCode"=>400,
                "graphError"=>$error,
                "fixtureDesc"=>"With Bad Request Response"
            ],
            [
                "token"=>"1111",
                "statusCode"=>404,
                "graphError"=>$error,
                "fixtureDesc"=>"With Not Found Response"
            ],
            [
                "token"=>"1111",
                "statusCode"=>401,
                "graphError"=>$error,
                "fixtureDesc"=>"With Unauthorized Response"
            ],
            [
                "token"=>"1111",
                "statusCode"=>403,
                "graphError"=>$error,
                "fixtureDesc"=>"With Forbidden Response"
            ]
        ];
    }

    public function initFixture(array $data)
    {
        $this->token=$data["token"];
        $this->graphError=$data["graphError"];
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
    public function Then_The_Graph_Error_Was_Decoded()
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
    public function Then_Pages_Were_Not_Attempted_To_Be_Decoded()
    {
        $this->mockPagesSerializer
            ->shouldNotHaveReceived("deserialize");
    }

    /**
     * @test
     */
    public function Then_Graph_Error_Occurs()
    {
        self::assertEquals(new GraphException($this->graphError),$this->exception);
    }

}