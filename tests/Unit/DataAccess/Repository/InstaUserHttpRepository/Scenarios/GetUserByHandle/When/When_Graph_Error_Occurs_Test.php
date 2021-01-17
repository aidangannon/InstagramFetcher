<?php

namespace InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserByHandle\When;


use InstaFetcher\DataAccess\Dtos\ErrorDto;
use InstaFetcher\DataAccess\Dtos\ErrorMetaDataDto;
use InstaFetcher\DataAccess\Http\Exception\GraphExceptions\Exceptions\GraphException;
use InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserByHandle\Given_User_Tries_To_Get_Insta_User_By_Handle;

/**
 * @testdox Given User Tries To Get Insta User By Handle, When Graph Error Occurs (DataAccess/Repository)
 */
class When_Graph_Error_Occurs_Test extends Given_User_Tries_To_Get_Insta_User_By_Handle
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
     * @test
     */
    public function Then_User_Not_Found_Error_Occurs()
    {
        self::assertEquals($this->exception, $this->tokenException);
    }
}