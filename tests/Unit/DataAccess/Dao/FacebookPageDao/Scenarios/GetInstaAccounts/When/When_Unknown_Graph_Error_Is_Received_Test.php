<?php


namespace InstaFetcherTests\Unit\DataAccess\Dao\FacebookPageDao\Scenarios\GetInstaAccounts\When;


use InstaFetcher\DataAccess\Http\Exception\GraphExceptions\Exceptions\GraphException;
use InstaFetcherTests\Unit\DataAccess\Dao\FacebookPageDao\Scenarios\GetInstaAccounts\Given_User_Tries_To_Fetch_Pages_With_The_Page_Insta_User;

class When_Unknown_Graph_Error_Is_Received_Test extends Given_User_Tries_To_Fetch_Pages_With_The_Page_Insta_User
{
    private int $statusCode;

    public function setUpClassProperties()
    {
        $this->mockHttpClient
            ->shouldReceive("request")
            ->andReturns($this->mockResponse);
        $this->mockResponse
            ->shouldReceive("getStatusCode")
            ->andReturns($this->statusCode);
    }

    public function fixtureProvider(): array
    {
        $token = "1111";

        return [
            [
                "statusCode"=>404,
                "token"=>$token
            ],
            [
                "statusCode"=>500,
                "token"=>$token
            ],
            [
                "statusCode"=>403,
                "token"=>$token
            ],
            [
                "statusCode"=>401,
                "token"=>$token
            ],
            [
                "statusCode"=>418,
                "token"=>$token
            ]
        ];
    }

    public function initFixture(array $data)
    {
        $this->statusCode=$data["statusCode"];
        $this->token=$data["token"];
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_Error_Code_Must_Not_Be_Validated()
    {
        $this->mockErrorValidator
            ->shouldNotHaveReceived("validateCode");
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_No_Dto_Should_Be_Deserialized()
    {
        $this->mockErrorSerializer
            ->shouldNotHaveReceived("deserialize");
        $this->mockPagesSerializer
            ->shouldNotHaveReceived("deserialize");
    }

    /**
     * @test
     */
    public function Then_GraphException_Should_Be_Thrown()
    {
        self::assertEquals(new GraphException,$this->exception);
    }
}