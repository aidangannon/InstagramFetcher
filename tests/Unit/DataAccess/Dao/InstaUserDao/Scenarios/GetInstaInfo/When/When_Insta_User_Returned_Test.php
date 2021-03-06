<?php


namespace InstaFetcherTests\Unit\DataAccess\Dao\InstaUserDao\Scenarios\GetInstaInfo\When;


use InstaFetcher\DataAccess\Dtos\InstaUserDto;
use InstaFetcherTests\Unit\DataAccess\Dao\InstaUserDao\Scenarios\GetInstaInfo\Given_User_Tries_To_Fetch_Insta_User_Info;

class When_Insta_User_Returned_Test extends Given_User_Tries_To_Fetch_Insta_User_Info
{
    private InstaUserDto $userDto;

    public function setUpClassProperties()
    {
        $this->mockResponse
            ->shouldReceive("getStatusCode")
            ->andReturns(200);

        $this->mockHttpClient
            ->shouldReceive("request")
            ->andReturns($this->mockResponse);
        $this->mockResponse
            ->shouldReceive("toArray");
        $this->mockUserSerializer
            ->shouldReceive("deserialize")
            ->andReturns($this->userDto);
    }

    public function fixtureProvider(): array
    {
        return [
            [
                "userDto"=>new InstaUserDto("000",100,"example_handle")
            ]
        ];
    }

    public function initFixture(array $data)
    {
        $this->userDto=$data["userDto"];
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