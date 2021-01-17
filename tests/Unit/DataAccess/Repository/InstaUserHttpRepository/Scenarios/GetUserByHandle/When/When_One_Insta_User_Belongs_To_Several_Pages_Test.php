<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserByHandle\When;


use InstaFetcher\DataAccess\Dtos\FacebookPageDto;
use InstaFetcher\DataAccess\Dtos\FacebookPagesDto;
use InstaFetcher\DataAccess\Dtos\InstaUserDto;
use InstaFetcher\DomainModels\InstaUser\InstaUserModel;
use InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserByHandle\Given_User_Tries_To_Get_Insta_User_By_Handle;

/**
 * @testdox Given User Tries To Get Insta User By Handle, When One Insta User Belongs To Several Pages (DataAccess/Repository)
 */
class When_One_Insta_User_Belongs_To_Several_Pages_Test extends Given_User_Tries_To_Get_Insta_User_By_Handle
{
    protected FacebookPagesDto $pages;

    public function setUpClassProperties()
    {
        $this->mockSession
            ->shouldReceive("getToken")
            ->andReturns($this->token);
        $this->mockPageDao
            ->shouldReceive("getInstaAccounts")
            ->with($this->token)
            ->andReturns($this->pages);
    }

    public function fixtureProvider(): array
    {
        $handle = "example_handle";
        $user = new InstaUserDto("22222", 100, $handle);

        return [
            [
                "token" => "00000",
                "handle" => $handle,
                "pages" => new FacebookPagesDto(
                    [
                        new FacebookPageDto(
                            "11111",
                            $user
                        ),
                        new FacebookPageDto(
                            "33333",
                            $user
                        )
                    ]
                )
            ]
        ];
    }

    public function initFixture(array $data)
    {
        $this->token = $data["token"];
        $this->handle = $data["handle"];
        $this->pages = $data["pages"];
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
    public function Then_Insta_Accounts_Were_Fetched()
    {
        $this->mockPageDao
            ->shouldHaveReceived("getInstaAccounts")
            ->once();
        $this->mockPageDao
            ->shouldHaveReceived("getInstaAccounts", [$this->token]);
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_User_Info_Was_Not_Fetched_Via_Id()
    {
        $this->mockUserDao
            ->shouldNotHaveReceived("getInstaInfo");
    }

    /**
     * @test
     */
    public function Then_First_User_Is_Returned()
    {
        self::assertEquals(new InstaUserModel("22222", 100, "example_handle"), $this->user);
    }
}