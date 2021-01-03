<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DataAccess\Dao\FacebookPageDao\Scenarios\GetInstaAccounts\When;


use InstaFetcher\DataAccess\Dtos\Serializers\Exception\ErrorDtoDeserializationError;
use InstaFetcherTests\Unit\DataAccess\Dao\FacebookPageDao\Scenarios\GetInstaAccounts\Given_User_Tries_To_Fetch_Pages_With_The_Page_Insta_User;

/**
 * <u> covers situations: </u>
 * * when an unknown error response is sent from graph api
 * * when facebook graph error schema changes
 */
class When_Error_Serialization_Throws_Error_Test extends Given_User_Tries_To_Fetch_Pages_With_The_Page_Insta_User
{

    public function setUpClassProperties()
    {
        $this->mockHttpClient
            ->shouldReceive("request")
            ->andReturns($this->mockResponse);
        $this->mockResponse
            ->shouldReceive("getStatusCode")
            ->andReturns(400);
        $this->mockResponse
            ->shouldReceive("toArray");
        $this->mockErrorSerializer
            ->shouldReceive("deserialize")
            ->andThrows(new ErrorDtoDeserializationError);
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