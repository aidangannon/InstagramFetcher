<?php


namespace InstaFetcherTests\Unit\DtoSerializers\FacebookPagesDtoSerializer\Scenarios\Deserialize;


use Exception;
use InstaFetcher\DataAccess\Dtos\FacebookPagesDto;
use InstaFetcherTests\Unit\DtoSerializers\FacebookPagesDtoSerializer\FacebookPagesDtoSerializerTestCase;

abstract class Given_Deserialize_Is_Called extends FacebookPagesDtoSerializerTestCase
{
    protected array $dataIn;
    protected FacebookPagesDto $result;
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