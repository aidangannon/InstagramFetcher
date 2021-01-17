<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserByHandle\When;


use InstaFetcher\DataAccess\Dtos\FacebookPageDto;
use InstaFetcher\DataAccess\Dtos\FacebookPagesDto;
use InstaFetcher\DataAccess\Http\Exception\InstaUserNotFound;
use InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserByHandle\Given_User_Tries_To_Get_Insta_User_By_Handle;

/**
 * @testdox Given User Tries To Get Insta User By Handle, When No Insta Users Returned (DataAccess/Repository)
 */
class When_No_Insta_Users_Returned_Test extends Given_User_Tries_To_Get_Insta_User_By_Handle
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
    public function Then_User_Not_Found_Error_Occurs(){
        self::assertTrue($this->exception instanceof InstaUserNotFound);
    }
}