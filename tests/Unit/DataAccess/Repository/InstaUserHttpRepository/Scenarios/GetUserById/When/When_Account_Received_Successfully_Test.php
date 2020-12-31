<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserById\When;


use InstaFetcher\DataAccess\Dtos\FacebookPageDto;
use InstaFetcher\DataAccess\Dtos\FacebookPagesDto;
use InstaFetcher\DataAccess\Dtos\InstaUserDto;
use InstaFetcher\DomainModels\InstaUser\InstaUserModel;
use InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserByHandle\Given_User_Tries_To_Get_User_By_Handle;
use InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserById\Given_User_Tries_To_Get_User_By_Id;

class When_Account_Received_Successfully_Test extends Given_User_Tries_To_Get_User_By_Id
{

    protected InstaUserDto $userDto;

    public function setUpClassProperties()
    {
        $this->mockSession
            ->shouldReceive("getToken")
            ->andReturns($this->token);
        $this->mockUserDao
            ->shouldReceive("getInstaInfo")
            ->with($this->id,$this->token)
            ->andReturns($this->userDto);
    }

    public function fixtureProvider(): array
    {
        return [
            [
                "userDto"=>new InstaUserDto("33333",100,"example_handle"),
                "token"=>"11111",
                "id"=>"33333"
            ]
        ];
    }

    public function initFixture(array $data)
    {
        $this->userDto=$data["userDto"];
        $this->token=$data["token"];
        $this->id=$data["id"];
    }

    /**
     * @test
     */
    public function Then_User_Returned_Should_Equal_The_Retrieved_User(){
        self::assertEquals($this->userDto->id,$this->user->getId());
        self::assertEquals($this->userDto->followersCount,$this->user->getFollowers());
        self::assertEquals($this->userDto->username,$this->user->getHandle());
    }

    /**
     * @test
     */
    public function Then_Token_Exception_Is_Not_Thrown(){
        self::assertFalse(isset($this->exception));
    }
}