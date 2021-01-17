<?php


namespace InstaFetcherTests\Unit\DataAccess\Dao\InstaUserDao\Scenarios\GetInstaInfo\When;


use InstaFetcherTests\Unit\DataAccess\Dao\InstaUserDao\Scenarios\GetInstaInfo\Given_User_Tries_To_Fetch_Insta_User_Info;
use Mockery;
use Mockery\MockInterface;
use Symfony\Component\HttpClient\Exception\TransportException;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * @testdox Given The User Tries To Fetch Insta User Info, When The Api Is Offline (DataAccess/Dao)
 */
class When_Api_Is_Offline_Test extends Given_User_Tries_To_Fetch_Insta_User_Info
{

    /**
     * @var ResponseInterface|MockInterface
     */
    protected $mockResponse;
    protected array $response=["fake"=>"response"];

    function setUpClassProperties()
    {
        $this->mockResponse = Mockery::mock(ResponseInterface::class);
        $this->mockResponse
            ->shouldReceive("getStatusCode")
            ->andThrow(TransportException::class);
        $this->mockHttpClient
            ->shouldReceive("request")
            ->andReturns($this->mockResponse);
    }

    function fixtureProvider(): array
    {
        //TODO: does nothing
        return [ [ ] ];
    }

    function initFixture(array $data)
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
    public function Then_The_User_Was_Not_Decoded()
    {
        $this->mockUserSerializer
            ->shouldNotHaveReceived("deserialize");
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
    public function Then_Transport_Layer_Error_Occurs()
    {
        self::assertInstanceOf(TransportException::class,$this->exception);
    }
}