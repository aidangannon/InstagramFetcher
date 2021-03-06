<?php


namespace InstaFetcherTests\Unit\DtoSerializers\ErrorMetaDtoSerializer\Scenarios\Deserialize\When;


use InstaFetcher\DataAccess\Dtos\Serializers\Exception\ErrorDtoDeserializationError;
use InstaFetcherTests\Unit\DtoSerializers\ErrorMetaDtoSerializer\Scenarios\Deserialize\Given_Deserialize_Is_Called;

/**
 * <u> covers situations: </u>
 * * when schema changes
 */
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
                    ["code"=>1212,"message"=>"random message","error_subcode"=>212]
            ],
            [
                "dataIn"=>
                    ["type"=>2121,"code"=>1212,"message"=>"random message","error_subcode"=>212]
            ],
            [
                "dataIn"=>
                    ["type"=>"blahBlah","message"=>"random message","error_subcode"=>212]
            ],
            [
                "dataIn"=>
                    ["type"=>"blahBlah","code"=>"not integer","message"=>"random message","error_subcode"=>212]
            ],
            [
                "dataIn"=>
                    ["type"=>"blahBlah","message"=>"random message","code"=>1212]
            ],
            [
                "dataIn"=>
                    ["type"=>"blahBlah","code"=>1212,"message"=>"random message","error_subcode"=>"not integer"]
            ],
            [
                "dataIn"=>
                    ["type"=>"blahBlah","code"=>1212,"error_subcode"=>123]
            ],
            [
                "dataIn"=>
                    ["type"=>"blahBlah","code"=>1212,"message"=>123,"error_subcode"=>123]
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