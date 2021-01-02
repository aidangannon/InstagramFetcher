<?php


namespace InstaFetcherTests\Unit\DataAccess\Dao\InstaUserDao\Scenarios\GetInstaInfo\When;


use InstaFetcherTests\Unit\DataAccess\Dao\InstaUserDao\Scenarios\GetInstaInfo\Given_User_Tries_To_Fetch_Insta_User_Info;
use Mockery;
use Symfony\Component\HttpClient\Exception\TransportException;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * <u> covers situations: </u>
 * * facebook offline
 * * http client error
 */
class When_Offline_Test extends Given_User_Tries_To_Fetch_Insta_User_Info
{

    function setUpClassProperties()
    {
        $mockResponse = Mockery::mock(ResponseInterface::class);
        $mockResponse
            ->shouldReceive("getStatusCode")
            ->andThrow(TransportException::class);
        $this->mockHttpClient
            ->shouldReceive("request")
            ->andReturns($mockResponse);
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
     * @test
     */
    public function Then_TransportException_Should_Be_Thrown(){
        self::assertInstanceOf(TransportException::class,$this->exception);
    }
}