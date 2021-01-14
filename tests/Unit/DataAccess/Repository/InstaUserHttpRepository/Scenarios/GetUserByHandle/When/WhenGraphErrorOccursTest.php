<?php

namespace InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserByHandle\When;


use InstaFetcher\DataAccess\Dtos\ErrorDto;
use InstaFetcher\DataAccess\Dtos\ErrorMetaDataDto;
use InstaFetcher\DataAccess\Http\Exception\GraphExceptions\Exceptions\GraphException;
use InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserByHandle\Given_User_Tries_To_Get_User_By_Handle;

/**
 * @testdox Given user tries to get user by handle, when a graph error occurs
 * <u> covers situations: </u>
 * * token expires
 * * token is invalid
 * * user doesnt have pages permission
 */
class WhenGraphErrorOccursTest extends Given_User_Tries_To_Get_User_By_Handle
{
    protected GraphException $tokenException;

    public function setUpClassProperties()
    {
        $this->mockSession
            ->shouldReceive("getToken")
            ->andReturns($this->token);
        $this->mockPageDao
            ->shouldReceive("getInstaAccounts")
            ->with($this->token)
            ->andThrow($this->tokenException);
    }

    public function fixtureProvider(): array
    {
        return [
            [
                "token" => "00000",
                "handle" => "example_handle",
                "tokenException" => new GraphException(new ErrorDto(new ErrorMetaDataDto("OAuthException",190,0)))
            ]
        ];
    }

    public function initFixture(array $data)
    {
        $this->token = $data["token"];
        $this->handle = $data["handle"];
        $this->tokenException = $data["tokenException"];
    }

    /**
     * @testdox User will not be found
     * @test
     */
    public function Then_InstaUserNotFound_Exception_Should_Be_Thrown()
    {
        self::assertEquals($this->exception, $this->tokenException);
    }
}