<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserByHandle;


use InstaFetcher\DataAccess\Dtos\FacebookPageDto;
use InstaFetcher\DataAccess\Dtos\FacebookPagesDto;
use InstaFetcher\DataAccess\Dtos\InstaUserDto;
use InstaFetcher\DomainModels\InstaUser\InstaUserModel;
use InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\Given_User_Tries_To_Get_User_By_Handle;

class When_One_Account_Belongs_To_Several_Pages_Test extends Given_User_Tries_To_Get_User_By_Handle
{
    protected string $token;
    protected FacebookPagesDto $pages;

    public function setUpMocks()
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
        return [
            [
                "token" => "00000",
                "handle" => "example_handle",
                "pages" => new FacebookPagesDto(
                    [
                        new FacebookPageDto(
                            "11111",
                            new InstaUserDto(
                                "22222",
                                100,
                                "example_handle"
                            )
                        ),
                        new FacebookPageDto(
                            "33333",
                            new InstaUserDto(
                                "22222",
                                100,
                                "example_handle"
                            )
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
     * @test
     */
    public function Then_User_Returned_Should_Equal_The_Retrieved_User()
    {
        self::assertEquals(new InstaUserModel("22222", 100, "example_handle"), $this->user);
    }

    /**
     * @test
     */
    public function Then_InstaUserNotFound_Exception_Is_Not_Thrown()
    {
        self::assertFalse(isset($this->exception));
    }
}