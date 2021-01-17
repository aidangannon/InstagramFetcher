<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserById\When;


use InstaFetcher\DataAccess\Dtos\InstaUserDto;
use InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserById\Given_User_Tries_To_Get_Insta_User_By_Id;

/**
 * @testdox Given User Tries To Get Insta User By Id, When Received Successfully (DataAccess/Repository)
 */
class When_Account_Received_Successfully_Test extends Given_User_Tries_To_Get_Insta_User_By_Id
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
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_Token_Was_Received_From_Facebook_Session()
    {
        $this->mockSession
            ->shouldHaveReceived("getToken");
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_Insta_User_Was_Fetched()
    {
        $this->mockUserDao
            ->shouldHaveReceived("getInstaInfo", [$this->id,$this->token]);
        $this->mockUserDao
            ->shouldHaveReceived("getInstaInfo")
            ->once();
    }

    /**
     * @test
     */
    public function Then_Correct_User_Is_Returned(){
        self::assertEquals($this->userDto->id,$this->user->getId());
        self::assertEquals($this->userDto->followersCount,$this->user->getFollowers());
        self::assertEquals($this->userDto->username,$this->user->getHandle());
    }
}