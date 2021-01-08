<?php


namespace InstaFetcherTests\Unit\DtoSerializers\ErrorDtoSerializer\Scenarios\Deserialize;


use Exception;
use InstaFetcher\DataAccess\Dtos\ErrorDto;
use InstaFetcherTests\Unit\DtoSerializers\ErrorDtoSerializer\ErrorDtoSerializerTestCase;

abstract class Given_Deserialize_Is_Called extends ErrorDtoSerializerTestCase
{
    protected array $dataIn;
    protected ErrorDto $result;
    protected Exception $exception;

    public function when()
    {
        try{
            $this->result = $this->sut->deserialize($this->dataIn);
        }
        catch(Exception $e) {
            $this->exception = $e;
        }
    }
}