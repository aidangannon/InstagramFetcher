<?php


namespace InstaFetcherTests\Integration\DataAccessLayer\InstaUserTests\Scenarios\GetUserById\When;


use InstaFetcher\DomainModels\InstaUser\InstaUserModel;
use InstaFetcherTests\Integration\DataAccessLayer\InstaUserTests\Scenarios\GetUserById\Given_User_Tries_To_Get_Insta_User_By_Id;

class When_Insta_User_Is_Fetched_Successfully_Test extends Given_User_Tries_To_Get_Insta_User_By_Id
{

    private array $instaUserResponse;
    private InstaUserModel $expectedUser;

    function setUpClassProperties()
    {
        $this->mockResponse
            ->shouldReceive("getStatusCode")
            ->andReturns(200);
        $this->mockResponse
            ->shouldReceive("toArray")
            ->andReturns($this->instaUserResponse);
    }

    function fixtureProvider(): array
    {
        return [
            [
                "instaUserResponse"=>
                [
                    "username"=>"aidan_gannonnn",
                    "followers_count"=>282,
                    "id"=>"17841405594881885"
                ],
                "id"=>"17841405594881885",
                "expectedUser"=>new InstaUserModel(
                    "17841405594881885",
                    282,
                    "aidan_gannonnn"
                )
            ]
        ];
    }

    function initFixture(array $data)
    {
        $this->instaUserResponse=$data["instaUserResponse"];
        $this->id=$data["id"];
        $this->expectedUser=$data["expectedUser"];
    }

    /**
     * @test
     */
    public function Then_Respective_User_Is_Returned(){
        self::assertEquals($this->user,$this->expectedUser);
    }
}