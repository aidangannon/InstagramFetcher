<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserById\When;


use InstaFetcher\DataAccess\Dtos\FacebookPageDto;
use InstaFetcher\DataAccess\Dtos\FacebookPagesDto;
use InstaFetcher\DataAccess\Http\Exception\GraphExceptions\Exceptions\InstaUserNotFound;
use InstaFetcher\DataAccess\Http\Exception\GraphExceptions\Exceptions\TokenException;
use InstaFetcher\DataAccess\Http\Exception\GraphExceptions\Exceptions\TokenNotAuthorised;
use InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserByHandle\Given_User_Tries_To_Get_User_By_Handle;
use InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserById\Given_User_Tries_To_Get_User_By_Id;

class When_Fetching_Insta_User_Is_Not_Authorized extends Given_User_Tries_To_Get_User_By_Id
{

    private TokenNotAuthorised $tokenException;

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
                "tokenException"=>new TokenNotAuthorised($token),
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
        self::assertTrue($this->exception instanceof TokenNotAuthorised);
        self::assertEquals($this->tokenException,$this->exception);
    }
}