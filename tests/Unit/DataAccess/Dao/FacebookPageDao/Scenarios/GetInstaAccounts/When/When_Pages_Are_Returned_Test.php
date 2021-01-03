<?php


namespace InstaFetcherTests\Unit\DataAccess\Dao\FacebookPageDao\Scenarios\GetInstaAccounts\When;


use InstaFetcher\DataAccess\Dtos\FacebookPageDto;
use InstaFetcher\DataAccess\Dtos\FacebookPagesDto;
use InstaFetcher\DataAccess\Dtos\InstaUserDto;
use InstaFetcherTests\Unit\DataAccess\Dao\FacebookPageDao\Scenarios\GetInstaAccounts\Given_User_Tries_To_Fetch_Pages_With_The_Page_Insta_User;

/**
 * <u> covers situations: </u>
 * * when user receives every page with its associated insta user
 */
class When_Pages_Are_Returned_Test extends Given_User_Tries_To_Fetch_Pages_With_The_Page_Insta_User
{
    private FacebookPagesDto $pagesDto;

    public function setUpClassProperties()
    {
        $this->mockHttpClient
            ->shouldReceive("request")
            ->andReturns($this->mockResponse);
        $this->mockResponse
            ->shouldReceive("toArray");
        $this->mockResponse
            ->shouldReceive("getStatusCode")
            ->andReturns(200);
        $this->mockPagesSerializer
            ->shouldReceive("deserialize")
            ->andReturns($this->pagesDto);
    }

    public function fixtureProvider(): array
    {
        return [
            [
                "token"=>"1111",
                "pagesDto"=>new FacebookPagesDto(
                    [
                        new FacebookPageDto(
                            "11111",
                            new InstaUserDto("1234",104,"example_handle")
                        )
                    ]
                )
            ]
        ];
    }

    public function initFixture(array $data)
    {
        $this->token=$data["token"];
        $this->pagesDto=$data["pagesDto"];
    }

    /**
     * @test
     */
    public function Then_Pages_Should_Be_Returned()
    {
        self::assertEquals($this->pagesDto,$this->pages);
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_Getting_Response_Body_Doesnt_Throw_Error()
    {
        $this->mockResponse
            ->shouldHaveReceived("toArray",[false]);
    }
}