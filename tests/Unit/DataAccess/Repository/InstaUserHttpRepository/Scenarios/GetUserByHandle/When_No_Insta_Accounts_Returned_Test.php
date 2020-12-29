<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserByHandle;


use InstaFetcher\DataAccess\Dtos\FacebookPageDto;
use InstaFetcher\DataAccess\Dtos\FacebookPagesDto;
use InstaFetcher\DataAccess\Http\Exception\InstaUserNotFound;
use InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\Given_User_Tries_To_Get_User_By_Handle;

class When_No_Insta_Accounts_Returned_Test extends Given_User_Tries_To_Get_User_By_Handle
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
                "pages" => new FacebookPagesDto([])
            ],
            [
                "token" => "00000",
                "handle" => "example_handle",
                "pages" => new FacebookPagesDto(
                    [
                        new FacebookPageDto(
                            "11111"
                        )
                    ]
                )
            ],
            [
                "token" => "00000",
                "handle" => "example_handle",
                "pages" => new FacebookPagesDto(
                    [
                        new FacebookPageDto(
                            "11111"
                        ),
                        new FacebookPageDto(
                            "33333"
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
    public function Then_User_Should_Not_Be_Returned()
    {
        self::assertFalse(isset($this->user));
    }

    /**
     * @test
     */
    public function Then_InstaUserNotFound_Exception_Should_Be_Thrown()
    {
        self::assertTrue($this->exception instanceof InstaUserNotFound);
    }

}