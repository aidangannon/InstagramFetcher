<?php


namespace InstaFetcherTests\Unit\DtoSerializers\ErrorMetaDtoSerializer\Scenarios\Deserialize;


use Exception;
use InstaFetcher\DataAccess\Dtos\ErrorMetaDataDto;
use InstaFetcherTests\Unit\DtoSerializers\ErrorMetaDtoSerializer\ErrorMetaDtoSerializerTestCase;

abstract class Given_Deserialize_Is_Called extends ErrorMetaDtoSerializerTestCase
{
    protected array $dataIn;
    protected ErrorMetaDataDto $result;
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