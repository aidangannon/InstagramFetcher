<?php


namespace InstaFetcherTests\Integration\DataAccessLayer\InstaUserTests\Scenarios\GetUserByHandle\When;


use InstaFetcher\DataAccess\Http\Exception\InstaUserNotFound;
use InstaFetcherTests\Integration\DataAccessLayer\InstaUserTests\Scenarios\GetUserByHandle\Given_User_Tries_To_Get_Insta_User_By_Handle;

class When_No_User_Not_Found_Test extends Given_User_Tries_To_Get_Insta_User_By_Handle
{
    private array $facebookPagesResponse;

    function setUpClassProperties()
    {
        $this->mockResponse
            ->shouldReceive("getStatusCode")
            ->andReturns(200);
        $this->mockResponse
            ->shouldReceive("toArray")
            ->andReturns($this->facebookPagesResponse);
    }

    function fixtureProvider(): array
    {
        return[
            [
                "facebookPagesResponse"=>
                    [
                        "data"=>
                        [
                            [
                                "id"=>"100361494710901"
                            ],
                            [
                                "id"=>"101229195179036"
                            ],
                            [
                                "instagram_business_account"=>[
                                    "username"=>"aidan_gannonnn",
                                    "followers_count"=>283,
                                    "id"=>"17841405594881885"
                                ],
                                "id"=>"100361494710901"
                            ],
                            [
                                "instagram_business_account"=>[
                                    "username"=>"aidan_gannon_api_test",
                                    "followers_count"=>3,
                                    "id"=>"17841428350043229"
                                ],
                                "id"=>"118367810031193"
                            ]
                        ],
                        "paging"=> [
                            "cursors"=> [
                                "before"=> "MTAwMzYxNDk0NzEwOTAx",
                                "after"=> "MTE4MzY3ODEwMDMxMTkz"
                            ]
                        ]
                    ],
                "handle"=>"undefined"
            ],
            [
                "facebookPagesResponse"=>
                    [
                        "data"=>
                        [
                            [
                                "id"=>"100361494710901"
                            ],
                            [
                                "id"=>"101229195179036"
                            ],
                            [
                                "id"=>"100361494710901"
                            ],
                            [
                                "id"=>"118367810031193"
                            ]
                        ],
                        "paging"=> [
                            "cursors"=> [
                                "before"=> "MTAwMzYxNDk0NzEwOTAx",
                                "after"=> "MTE4MzY3ODEwMDMxMTkz"
                            ]
                        ]
                    ],
                "handle"=>"aidan_gannon_api_test"
            ]
        ];
    }

    function initFixture(array $data)
    {
        $this->facebookPagesResponse=$data["facebookPagesResponse"];
        $this->handle=$data["handle"];
    }

    /**
     * @test
     */
    public function Then_UserNotFoundException_Is_Thrown(){
        self::assertInstanceOf(InstaUserNotFound::class,$this->exception);
    }
}