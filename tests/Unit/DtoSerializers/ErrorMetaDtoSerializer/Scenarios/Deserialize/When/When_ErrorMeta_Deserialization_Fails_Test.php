<?php


namespace InstaFetcherTests\Unit\DtoSerializers\ErrorMetaDtoSerializer\Scenarios\Deserialize\When;


use InstaFetcher\DataAccess\Dtos\Serializers\Exception\ErrorDtoDeserializationError;
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
                    ["code"=>1212,"error_subcode"=>212]
            ],
            [
                "dataIn"=>
                    ["type"=>2121,"code"=>1212,"error_subcode"=>212]
            ],
            [
                "dataIn"=>
                    ["type"=>"blahBlah","error_subcode"=>212]
            ],
            [
                "dataIn"=>
                    ["type"=>"blahBlah","code"=>"not integer","error_subcode"=>212]
            ],
            [
                "dataIn"=>
                    ["type"=>"blahBlah","code"=>1212]
            ],
            [
                "dataIn"=>
                    ["type"=>"blahBlah","code"=>1212,"error_subcode"=>"not integer"]
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
        self::assertInstanceOf(ErrorDtoDeserializationError::class,$this->exception);
    }
}