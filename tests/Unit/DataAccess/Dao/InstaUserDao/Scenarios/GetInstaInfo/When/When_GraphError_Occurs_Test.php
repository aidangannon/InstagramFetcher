<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DataAccess\Dao\InstaUserDao\Scenarios\GetInstaInfo\When;


use InstaFetcher\DataAccess\Dtos\ErrorDto;
use InstaFetcher\DataAccess\Dtos\ErrorMetaDataDto;
use InstaFetcher\DataAccess\Http\Exception\GraphExceptions\Exceptions\GraphException;
use InstaFetcherTests\Unit\DataAccess\Dao\InstaUserDao\Scenarios\GetInstaInfo\Given_User_Tries_To_Fetch_Insta_User_Info;

/**
 * <u> covers situations: </u>
 * * invalid not found
 * * trying to fetch a insta user that doesnt belong to the user
 * * user not authorized
 * * token expired
 */
class When_GraphError_Occurs_Test extends Given_User_Tries_To_Fetch_Insta_User_Info
{
    private ErrorDto $graphError;
    private int $statusCode;

    public function setUpClassProperties()
    {
        $this->mockResponse
            ->shouldReceive("getStatusCode")
            ->andThrows($this->statusCode);

        $this->mockHttpClient
            ->shouldReceive("request")
            ->andReturns($this->mockResponse);
        $this->mockErrorSerializer
            ->shouldReceive("deserialize")
            ->andReturns($this->graphError);
    }

    public function fixtureProvider(): array
    {

        $error = new ErrorDto(new ErrorMetaDataDto("BlahBlah",3213,321321));

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