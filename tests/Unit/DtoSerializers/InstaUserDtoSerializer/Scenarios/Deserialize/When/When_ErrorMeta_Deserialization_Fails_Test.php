<?php


namespace InstaFetcherTests\Unit\DtoSerializers\InstaUserDtoSerializer\Scenarios\Deserialize\When;


use InstaFetcher\DataAccess\Dtos\Serializers\Exception\InstaUserDtoDeserializationError;
use InstaFetcherTests\Unit\DtoSerializers\ErrorMetaDtoSerializer\Scenarios\Deserialize\Given_Deserialize_Is_Called;

class When_ErrorMeta_Deserialization_Fails_Test extends Given_Deserialize_Is_Called
{

    function setUpClassProperties()
    {
    }

    function fixtureProvider(): array
    {

        return [
            [
                "dataIn"=>
                    ["invalidData2"=>"data","invalidData3"=>"data2"]
            ],
            [
                "dataIn"=>
                    ["id"=>123213321,"followers_count"=>1212,"username"=>"bigbadman"]
            ],
            [
                "dataIn"=>
                    ["followers_count"=>1212,"username"=>"bigbadman"]
            ],
            [
                "dataIn"=>
                    ["id"=>"123213321","followers_count"=>"1211","username"=>"bigbadman"]
            ],
            [
                "dataIn"=>
                    ["id"=>"123213321","username"=>"bigbadman"]
            ],
            [
                "dataIn"=>
                    ["id"=>"123213321","followers_count"=>1211,"username"=>12121]
            ],
            [
                "dataIn"=>
                    ["id"=>"123213321","followers_count"=>1211]
            ],
            [
                "dataIn"=>
                    []
            ]
        ];
    }

    function initFixture(array $data)
    {
        $this->dataIn = $data["dataIn"];
    }

    /**
     * @test
     */
    function Then_ErrorDtoDeserializationError_Should_Be_Thrown()
    {
        self::assertInstanceOf(InstaUserDtoDeserializationError::class,$this->exception);
    }
}