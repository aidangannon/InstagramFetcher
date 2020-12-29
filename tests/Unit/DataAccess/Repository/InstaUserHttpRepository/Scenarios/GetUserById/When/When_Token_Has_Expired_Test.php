<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserById\When;


use InstaFetcher\DataAccess\Dtos\FacebookPageDto;
use InstaFetcher\DataAccess\Dtos\FacebookPagesDto;
use InstaFetcher\DataAccess\Dtos\InstaUserDto;
use InstaFetcher\DataAccess\Http\Exception\InstaUserNotFound;
use InstaFetcher\DataAccess\Http\Exception\TokenException;
use InstaFetcher\DataAccess\Http\Exception\TokenExpired;
use InstaFetcher\DataAccess\Http\Exception\TokenNotAuthorised;
use InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserByHandle\Given_User_Tries_To_Get_User_By_Handle;
use InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserById\Given_User_Tries_To_Get_User_By_Id;

class When_Token_Has_Expired_Test extends Given_User_Tries_To_Get_User_By_Id
{

    private TokenExpired $tokenException;

    public function setUpMocks()
    {
        $this->mockSession
            ->shouldReceive("getToken")
            ->andReturns($this->token);
        $this->mockUserDao
            ->shouldReceive("getInstaInfo")
            ->with($this->id,$this->token)
            ->andThrow($this->tokenException);
    }

    public function fixtureProvider(): array
    {
        $token = "11111";

        return [
            [
                "tokenException"=>new TokenExpired($token),
                "token"=>$token,
                "id"=>"33333"
            ]
        ];
    }

    public function initFixture(array $data)
    {
        $this->tokenException=$data["tokenException"];
        $this->token=$data["token"];
        $this->id=$data["id"];
    }

    /**
     * @test
     */
    public function Then_User_Should_Not_Be_Returned(){
        self::assertFalse(isset($this->user));
    }

    /**
     * @test
     */
    public function Then_TokenNotAuthorized_Exception_Is_Thrown(){
        self::assertTrue($this->exception instanceof TokenExpired);
        self::assertEquals($this->tokenException,$this->exception);
    }
}