<?php


namespace InstaFetcherTests\Unit\DataAccess\Dao\InstaUserDao\Scenarios\GetInstaInfo\When;


use InstaFetcher\DataAccess\Dtos\Serializers\Exception\ErrorDtoDeserializationError;
use InstaFetcherTests\Unit\DataAccess\Dao\InstaUserDao\Scenarios\GetInstaInfo\Given_User_Tries_To_Fetch_Insta_User_Info;

/**
 * <u> covers situations: </u>
 * * when unknown error response is sent from graph api
 * * when graph error schema changes
 */
class When_Error_Serialization_Throws_Error_Test extends Given_User_Tries_To_Fetch_Insta_User_Info
{

    private int $statusCode;

    public function setUpClassProperties()
    {
        $this->mockResponse
            ->shouldReceive("getStatusCode")
            ->andReturns($this->statusCode);

        $this->mockHttpClient
            ->shouldReceive("request")
            ->andReturns($this->mockResponse);
        $this->mockResponse
            ->shouldReceive("toArray");
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
     * @test
     */
    public function Then_DeserializationException_Should_Be_Thrown()
    {
        self::assertInstanceOf(ErrorDtoDeserializationError::class,$this->exception);
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_Getting_Response_Body_Doesnt_Throw_Error()
    {
        $this->mockResponse
            ->shouldHaveReceived("toArray",[false]);
    }
}