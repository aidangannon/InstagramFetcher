<?php


namespace InstaFetcherTests\Unit\DtoSerializers\FacebookPageDtoSerializer\Scenarios\Deserialize\When;


use InstaFetcher\DataAccess\Dtos\FacebookPageDto;
use InstaFetcherTests\Unit\DtoSerializers\FacebookPageDtoSerializer\Scenarios\Deserialize\Given_Deserialize_Is_Called;

class When_Page_Doesnt_Have_An_Insta_User_Test extends Given_Deserialize_Is_Called
{

    private FacebookPageDto $pageReturn;

    function setUpClassProperties()
    {
    }

    function fixtureProvider(): array
    {
        return
            [
                [
                    "dataIn"=>["id"=>"12321312"],
                    "pageReturn"=>new FacebookPageDto("12321312")
                ]
            ];
    }

    function initFixture(array $data)
    {
        $this->pageReturn=$data["pageReturn"];
        $this->dataIn=$data["dataIn"];
    }

    /**
     * @test
     */
    public function Then_Page_Should_Be_Returned(){
        self::assertEquals($this->pageReturn,$this->result);
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_InstaUser_Should_Not_Be_Deserialized(){
        $this->mockInstaUserDtoSerializer
            ->shouldNotHaveReceived("deserialize");
    }
}