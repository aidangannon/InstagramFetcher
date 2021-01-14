<?php


namespace InstaFetcherTests\Integration\DataAccessLayer\InstaUserTests\Scenarios\GetUserByHandle\When;


use InstaFetcher\DomainModels\InstaUser\InstaUserModel;
use InstaFetcherTests\Integration\DataAccessLayer\InstaUserTests\Scenarios\GetUserByHandle\Given_User_Tries_To_Get_Insta_User_By_Handle;

class When_Insta_User_Is_Fetched_Successfully_Test extends Given_User_Tries_To_Get_Insta_User_By_Handle
{

    private InstaUserModel $expectedUser;
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
                "handle"=>"aidan_gannonnn",
                "expectedUser"=>new InstaUserModel(
                    "17841405594881885",
                    283,
                    "aidan_gannonnn"
                )
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
                "handle"=>"aidan_gannon_api_test",
                "expectedUser"=>new InstaUserModel(
                    "17841428350043229",
                    3,
                    "aidan_gannon_api_test"
                )
            ]
        ];
    }

    function initFixture(array $data)
    {
        $this->expectedUser=$data["expectedUser"];
        $this->facebookPagesResponse=$data["facebookPagesResponse"];
        $this->handle=$data["handle"];
    }

    /**
     * @test
     */
    public function Then_Respective_User_Is_Returned(){
        self::assertEquals($this->user,$this->expectedUser);
    }

}