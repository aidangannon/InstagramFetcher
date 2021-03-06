<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DtoSerializers\ErrorMetaDtoSerializer\Scenarios\Deserialize\When;


use InstaFetcher\DataAccess\Dtos\ErrorMetaDataDto;
use InstaFetcherTests\Unit\DtoSerializers\ErrorMetaDtoSerializer\Scenarios\Deserialize\Given_Deserialize_Is_Called;

/**
 * <u> covers situations: </u>
 * * when schema remains the same
 */
class When_Deserialization_Is_Successful_Test extends Given_Deserialize_Is_Called
{

    private ErrorMetaDataDto $expectedResult;

    function setUpClassProperties()
    {
        //TODO: does nothing
    }

    function fixtureProvider(): array
    {

        return [
            [
                "dataIn"=>["type"=>"Auth","code"=>1212,"message"=>"random message","error_subcode"=>212],
                "expectedResult"=>new ErrorMetaDataDto("Auth",1212,"random message",212),
            ],
            [
                "dataIn"=>["type"=>"Auth","code"=>1212,"message"=>"random message"],
                "expectedResult"=>new ErrorMetaDataDto("Auth",1212,"random message"),
            ],
            [
                "dataIn"=>["type"=>"Auth","code"=>1212,"message"=>"random message","error_subcode"=>212,"extraField"=>21212321],
                "expectedResult"=>new ErrorMetaDataDto("Auth",1212,"random message",212)
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
    function Then_ErrorMetaDto_Is_Returned()
    {
        self::assertEquals($this->expectedResult,$this->result);
    }
}