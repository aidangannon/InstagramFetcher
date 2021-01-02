<?php


namespace InstaFetcherTests\Unit\DataAccess\Dao\FacebookPageDao\Scenarios\GetInstaAccounts\When;


use InstaFetcher\DataAccess\Dtos\Serializers\Exception\FacebookPagesDtoDeserializationError;
use InstaFetcherTests\Unit\DataAccess\Dao\FacebookPageDao\Scenarios\GetInstaAccounts\Given_User_Tries_To_Fetch_Pages_With_The_Page_Insta_User;

/**
 * <u> covers situations: </u>
 * * when facebook graph page schema changes
 */
class When_Pages_Serialization_Throws_Error_Test extends Given_User_Tries_To_Fetch_Pages_With_The_Page_Insta_User
{

    public function setUpClassProperties()
    {
        $this->mockHttpClient
            ->shouldReceive("request")
            ->andReturns($this->mockResponse);
        $this->mockResponse
            ->shouldReceive("getStatusCode")
            ->andReturns(200);
        $this->mockResponse
            ->shouldReceive("toArray");
        $this->mockPagesSerializer
            ->shouldReceive("deserialize")
            ->andThrows(new FacebookPagesDtoDeserializationError);
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
        self::assertInstanceOf(FacebookPagesDtoDeserializationError::class,$this->exception);
    }
}