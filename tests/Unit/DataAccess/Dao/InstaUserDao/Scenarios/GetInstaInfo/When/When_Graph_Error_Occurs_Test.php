<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DataAccess\Dao\InstaUserDao\Scenarios\GetInstaInfo\When;


use InstaFetcher\DataAccess\Dtos\ErrorDto;
use InstaFetcher\DataAccess\Dtos\ErrorMetaDataDto;
use InstaFetcher\DataAccess\Http\Exception\GraphExceptions\Exceptions\GraphException;
use InstaFetcherTests\Unit\DataAccess\Dao\InstaUserDao\Scenarios\GetInstaInfo\Given_User_Tries_To_Fetch_Insta_User_Info;
use Mockery;
use Mockery\MockInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * @testdox Given User Tries To Fetch Insta User Info, When Graph Error Occurs (DataAccess/Dao)
 */
class When_Graph_Error_Occurs_Test extends Given_User_Tries_To_Fetch_Insta_User_Info
{

    /**
     * @var ResponseInterface|MockInterface
     */
    protected $mockResponse;
    protected array $response=["fake"=>"response"];

    private ErrorDto $graphError;
    private int $statusCode;

    public function setUpClassProperties()
    {
        $this->mockResponse = Mockery::mock(ResponseInterface::class);
        $this->mockResponse
            ->shouldReceive("getStatusCode")
            ->andReturns($this->statusCode);
        $this->mockResponse
            ->shouldReceive("toArray")
            ->andReturns($this->response);
        $this->mockHttpClient
            ->shouldReceive("request")
            ->andReturns($this->mockResponse);
        $this->mockErrorSerializer
            ->shouldReceive("deserialize")
            ->andReturns($this->graphError);
    }

    public function fixtureProvider(): array
    {

        $error = new ErrorDto(new ErrorMetaDataDto("BlahBlah",3213,"message",321321));

        return [
            [
                "statusCode"=>400,
                "graphError"=>$error
            ],
            [
                "statusCode"=>404,
                "graphError"=>$error
            ],
            [
                "statusCode"=>401,
                "graphError"=>$error
            ],
            [
                "statusCode"=>403,
                "graphError"=>$error
            ]
        ];
    }

    public function initFixture(array $data)
    {
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
    public function Then_Error_Was_Decoded()
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
    public function Then_Graph_Error_Error_Occurs()
    {
        self::assertInstanceOf(GraphException::class,$this->exception);
    }

}