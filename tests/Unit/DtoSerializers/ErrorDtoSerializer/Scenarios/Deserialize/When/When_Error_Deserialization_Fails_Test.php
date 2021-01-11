<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DtoSerializers\ErrorDtoSerializer\Scenarios\Deserialize\When;

use InstaFetcher\DataAccess\Dtos\Serializers\Exception\ErrorDtoDeserializationError;
use InstaFetcherTests\Unit\DtoSerializers\ErrorDtoSerializer\Scenarios\Deserialize\Given_Deserialize_Is_Called;

/**
 * <u> covers situations: </u>
 * * when error schema is modified
 */
class When_Error_Deserialization_Fails_Test extends Given_Deserialize_Is_Called
{

    function setUpClassProperties()
    {
    }

    function fixtureProvider(): array
    {
        return [
            [
                "dataIn"=>
                    ["invalidData"=>["invalidData2"=>"data","invalidData3"=>"data2"]]
            ],
            [
                "dataIn"=>
                    ["invalidData"=>"data"]
            ],
            [
                "dataIn"=>
                    [["invalidData"=>"data"],["invalidData2"=>"data2"]]
            ],
            [
                "dataIn"=>
                    []
            ],
            [
                "dataIn"=>
                    ["error"=>"notAnArray"]
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

    /**
     * @doesNotPerformAssertions
     * @test
     */
    function Then_Deserialize_ErrorMetaDto_Is_Not_Called()
    {
        $this->mockErrorMetaSerializer
            ->shouldNotHaveReceived("deserialize");
    }
}