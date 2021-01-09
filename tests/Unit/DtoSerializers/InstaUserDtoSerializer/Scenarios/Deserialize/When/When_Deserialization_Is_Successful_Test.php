<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DtoSerializers\InstaUserDtoSerializer\Scenarios\Deserialize\When;


use InstaFetcher\DataAccess\Dtos\InstaUserDto;
use InstaFetcherTests\Unit\DtoSerializers\InstaUserDtoSerializer\Scenarios\Deserialize\Given_Deserialize_Is_Called;

class When_Deserialization_Is_Successful_Test extends Given_Deserialize_Is_Called
{

    private InstaUserDto $expectedResult;

    function setUpClassProperties()
    {
        //TODO: does nothing
    }

    function fixtureProvider(): array
    {

        return [
            [
                "dataIn"=>["id"=>"123213321","followers_count"=>1212,"username"=>"bigbadman","follows_count"=>2111],
                "expectedResult"=>new InstaUserDto("123213321",1212,"bigbadman")
            ],
            [
                "dataIn"=>["id"=>"123213321","followers_count"=>1212,"username"=>"bigbadman"],
                "expectedResult"=>new InstaUserDto("123213321",1212,"bigbadman")
            ]
        ];
    }

    function initFixture(array $data)
    {
        $this->dataIn = $data["dataIn"];
        $this->expectedResult = $data["expectedResult"];
    }

    /**
     * @test
     */
    function Then_ErrorDto_Is_Returned()
    {
        self::assertEquals($this->expectedResult,$this->result);
    }
}