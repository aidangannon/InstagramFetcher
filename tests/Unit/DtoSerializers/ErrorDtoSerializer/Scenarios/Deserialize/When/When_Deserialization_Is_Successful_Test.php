<?php


namespace InstaFetcherTests\Unit\DtoSerializers\ErrorDtoSerializer\Scenarios\Deserialize\When;


use InstaFetcher\DataAccess\Dtos\ErrorDto;
use InstaFetcher\DataAccess\Dtos\ErrorMetaDataDto;
use InstaFetcherTests\Unit\DtoSerializers\ErrorDtoSerializer\Scenarios\Deserialize\Given_Deserialize_Is_Called;

class When_Deserialization_Is_Successful_Test extends Given_Deserialize_Is_Called
{

    private array $errorMetaInput;
    private ErrorMetaDataDto $errorMetaResult;
    private ErrorDto $expectedResult;

    function setUpClassProperties()
    {
        $this->mockErrorMetaSerializer
            ->shouldReceive("deserialize")
            ->andReturns($this->errorMetaResult);
    }

    function fixtureProvider(): array
    {
        $errorMetaInput=["type"=>"testType","code"=>102,"error_subcode"=>121];
        $errorMeta = new ErrorMetaDataDto("testType",102,121);

        return [
            [
                "dataIn"=>["error"=>$errorMetaInput],
                "errorMetaInput"=>$errorMetaInput,
                "expectedResult"=>new ErrorDto($errorMeta),
                "errorMetaResult"=>$errorMeta
            ],
            [
                "dataIn"=>["error"=>$errorMetaInput,"extraField"=>"extra"],
                "errorMetaInput"=>$errorMetaInput,
                "expectedResult"=>new ErrorDto($errorMeta),
                "errorMetaResult"=>$errorMeta
            ]
        ];
    }

    function initFixture(array $data)
    {
        $this->dataIn = $data["dataIn"];
        $this->errorMetaInput = $data["errorMetaInput"];
        $this->expectedResult = $data["expectedResult"];
        $this->errorMetaResult = $data["errorMetaResult"];
    }

    /**
     * @test
     */
    function Then_ErrorDto_Is_Returned()
    {
        self::assertEquals($this->expectedResult,$this->result);
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