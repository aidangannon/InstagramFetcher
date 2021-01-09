<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DtoSerializers\InstaUserDtoSerializer\Scenarios\Deserialize;


use Exception;
use InstaFetcher\DataAccess\Dtos\InstaUserDto;
use InstaFetcherTests\Unit\DtoSerializers\InstaUserDtoSerializer\InstaUserDtoSerializerTestCase;

abstract class Given_Deserialize_Is_Called extends InstaUserDtoSerializerTestCase
{
    protected array $dataIn;
    protected InstaUserDto $result;
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