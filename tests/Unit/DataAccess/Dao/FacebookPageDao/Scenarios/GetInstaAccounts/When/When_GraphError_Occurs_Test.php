<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DataAccess\Dao\FacebookPageDao\Scenarios\GetInstaAccounts\When;


use InstaFetcher\DataAccess\Dtos\ErrorDto;
use InstaFetcher\DataAccess\Dtos\ErrorMetaDataDto;
use InstaFetcher\DataAccess\Http\Exception\GraphExceptions\Exceptions\GraphException;
use InstaFetcherTests\Unit\DataAccess\Dao\FacebookPageDao\Scenarios\GetInstaAccounts\Given_User_Tries_To_Fetch_Pages_With_The_Page_Insta_User;

/**
 * <u> covers situations: </u>
 * * when token has expired
 * * when token doesnt have page permission
 * * when appsecret proof is not present
 */
class When_GraphError_Occurs_Test extends Given_User_Tries_To_Fetch_Pages_With_The_Page_Insta_User
{
    private ErrorDto $graphError;
    private int $statusCode;

    public function setUpClassProperties()
    {
        $this->mockHttpClient
            ->shouldReceive("request")
            ->andReturns($this->mockResponse);
        $this->mockResponse
            ->shouldReceive("getStatusCode")
            ->andReturns($this->statusCode);
        $this->mockResponse
            ->shouldReceive("toArray");
        $this->mockErrorSerializer
            ->shouldReceive("deserialize")
            ->andReturns($this->graphError);
    }

    public function fixtureProvider(): array
    {

        $error = new ErrorDto(new ErrorMetaDataDto("BlahBlah",3213,321321));

        return [
            [
                "token"=>"1111",
                "statusCode"=>400,
                "graphError"=>$error
            ],
            [
                "token"=>"1111",
                "statusCode"=>404,
                "graphError"=>$error
            ],
            [
                "token"=>"1111",
                "statusCode"=>401,
                "graphError"=>$error
            ],
            [
                "token"=>"1111",
                "statusCode"=>403,
                "graphError"=>$error
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
    public function Then_Error_Should_Be_Deserialized()
    {
        $this->mockErrorSerializer
            ->shouldHaveReceived("deserialize");
    }

    /**
     * @test
     */
    public function Then_GraphException_Should_Be_Thrown()
    {
        self::assertEquals(new GraphException($this->graphError),$this->exception);
    }

}