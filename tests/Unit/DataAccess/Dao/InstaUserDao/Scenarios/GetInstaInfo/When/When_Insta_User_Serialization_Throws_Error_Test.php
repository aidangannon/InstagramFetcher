<?php


namespace InstaFetcherTests\Unit\DataAccess\Dao\InstaUserDao\Scenarios\GetInstaInfo\When;

use InstaFetcher\DataAccess\Dtos\Serializers\Exception\InstaUserDtoDeserializationError;
use InstaFetcherTests\Unit\DataAccess\Dao\InstaUserDao\Scenarios\GetInstaInfo\Given_User_Tries_To_Fetch_Insta_User_Info;
use Mockery;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * <u> covers situations: </u>
 * * when facebook graph insta user schema changes
 */
class When_Insta_User_Serialization_Throws_Error_Test extends Given_User_Tries_To_Fetch_Insta_User_Info
{

    public function setUpClassProperties()
    {
        $mockResponse = Mockery::mock(ResponseInterface::class);
        $mockResponse
            ->shouldReceive("getStatusCode")
            ->andThrows(200);

        $this->mockHttpClient
            ->shouldReceive("request")
            ->andReturns($mockResponse);
        $mockResponse
            ->shouldReceive("toArray");
        $this->mockUserSerializer
            ->shouldReceive("deserialize")
            ->andThrows(new InstaUserDtoDeserializationError);
    }

    public function fixtureProvider(): array
    {
        //TODO: does nothing
        return [ ];
    }

    public function initFixture(array $data)
    {
        //TODO: does nothing
    }

    /**
     * @test
     */
    public function Then_DeserializationException_Should_Be_Thrown()
    {
        self::assertInstanceOf(InstaUserDtoDeserializationError::class,$this->exception);
    }
}