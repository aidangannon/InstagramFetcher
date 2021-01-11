<?php


namespace InstaFetcherTests\Unit\DtoSerializers\FacebookPageDtoSerializer\Scenarios\Deserialize;


use Exception;
use InstaFetcher\DataAccess\Dtos\FacebookPageDto;
use InstaFetcherTests\Unit\DtoSerializers\FacebookPageDtoSerializer\FacebookPageDtoSerializerTestCase;

abstract class Given_Deserialize_Is_Called extends FacebookPageDtoSerializerTestCase
{
    protected array $dataIn;
    protected FacebookPageDto $result;
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