<?php

namespace InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserByHandle\When;


use InstaFetcher\DataAccess\Dtos\FacebookPageDto;
use InstaFetcher\DataAccess\Dtos\FacebookPagesDto;
use InstaFetcher\DataAccess\Dtos\InstaUserDto;
use InstaFetcher\DataAccess\Http\Exception\GraphExceptions\Exceptions\InstaUserNotFound;
use InstaFetcher\DataAccess\Http\Exception\GraphExceptions\Exceptions\TokenException;
use InstaFetcher\DataAccess\Http\Exception\GraphExceptions\Exceptions\TokenExpired;
use InstaFetcher\DataAccess\Http\Exception\GraphExceptions\Exceptions\TokenNotAuthorised;
use InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserByHandle\Given_User_Tries_To_Get_User_By_Handle;

class When_Token_Is_Invalid_Test extends Given_User_Tries_To_Get_User_By_Handle
{
    protected TokenException $tokenException;

    public function setUpMocks()
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
                "tokenException" => new TokenExpired("00000")
            ],
            [
                "token" => "00000",
                "handle" => "example_handle",
                "tokenException" => new TokenNotAuthorised("00000")
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
    public function Then_User_Should_Not_Be_Returned()
    {
        self::assertFalse(isset($this->user));
    }

    /**
     * @test
     */
    public function Then_InstaUserNotFound_Exception_Should_Be_Thrown()
    {
        self::assertEquals($this->exception, $this->tokenException);
    }
}