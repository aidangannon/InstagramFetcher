<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserByHandle\When;


use InstaFetcher\DataAccess\Dtos\FacebookPageDto;
use InstaFetcher\DataAccess\Dtos\FacebookPagesDto;
use InstaFetcher\DataAccess\Dtos\InstaUserDto;
use InstaFetcher\DataAccess\Http\Exception\InstaUserNotFound;
use InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserByHandle\Given_User_Tries_To_Get_User_By_Handle;

/**
 * <u> covers situations: </u>
 * * if insta user doesnt exist
 * * if insta user is not authorized currently
 * * if insta user doesnt belong to user
 */
class When_Handle_Is_Invalid_Test extends Given_User_Tries_To_Get_User_By_Handle
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
        return [
            [
                "token"=>"00000",
                "handle"=>"example_handle",
                "pages"=>new FacebookPagesDto(
                    [
                        new FacebookPageDto(
                            "11111",
                            new InstaUserDto(
                                "22222",
                                100,
                                "test1"
                            )
                        )
                    ]
                )
            ],
            [
                "token"=>"00000",
                "handle"=>"example_handle",
                "pages"=>new FacebookPagesDto(
                    [
                        new FacebookPageDto(
                            "11111",
                            new InstaUserDto(
                                "22222",
                                100,
                                "test1"
                            )
                        ),
                        new FacebookPageDto(
                            "33333",
                            new InstaUserDto(
                                "444444",
                                100,
                                "test2"
                            )
                        )
                    ]
                )
            ]
        ];
    }

    public function initFixture(array $data)
    {
        $this->token=$data["token"];
        $this->handle=$data["handle"];
        $this->pages=$data["pages"];
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
    public function Then_InstaUserNotFound_Exception_Should_Be_Thrown(){
        self::assertTrue($this->exception instanceof InstaUserNotFound);
    }
}