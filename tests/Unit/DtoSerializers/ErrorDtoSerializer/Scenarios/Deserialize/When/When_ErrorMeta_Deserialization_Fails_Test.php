<?php


namespace InstaFetcherTests\Unit\DtoSerializers\ErrorDtoSerializer\Scenarios\Deserialize\When;


use InstaFetcher\DataAccess\Dtos\Serializers\Exception\ErrorDtoDeserializationError;
use InstaFetcherTests\Unit\DtoSerializers\ErrorDtoSerializer\Scenarios\Deserialize\Given_Deserialize_Is_Called;

class When_ErrorMeta_Deserialization_Fails_Test extends Given_Deserialize_Is_Called
{

    private array $errorMetaInput;

    function setUpClassProperties()
    {
        $this->mockErrorMetaSerializer
            ->shouldReceive("deserialize")
            ->andThrows(new ErrorDtoDeserializationError());
    }

    function fixtureProvider(): array
    {

        return [
            [
                "dataIn"=>
                    ["error"=>["invalidData2"=>"data","invalidData3"=>"data2"]],
                "errorMetaInput"=>["invalidData2"=>"data","invalidData3"=>"data2"]
            ]
        ];
    }

    function initFixture(array $data)
    {
        $this->dataIn = $data["dataIn"];
        $this->errorMetaInput = $data["errorMetaInput"];
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
    function Then_Deserialize_ErrorMetaDto_Is_Called_With_Valid_Args()
    {
        $this->mockErrorMetaSerializer
            ->shouldHaveReceived("deserialize",[$this->errorMetaInput]);
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    function Then_Deserialize_ErrorMetaDto_Is_Called_Once()
    {
        $this->mockErrorMetaSerializer
            ->shouldHaveReceived("deserialize")
            ->once();
    }
}