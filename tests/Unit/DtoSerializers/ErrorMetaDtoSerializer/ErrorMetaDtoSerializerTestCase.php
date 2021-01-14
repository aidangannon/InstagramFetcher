<?php


namespace InstaFetcherTests\Unit\DtoSerializers\ErrorMetaDtoSerializer;


use InstaFetcher\DataAccess\Dtos\Serializers\ErrorMetaDtoSerializer;
use InstaFetcherTests\GwtTestCase;

abstract class ErrorMetaDtoSerializerTestCase extends GwtTestCase
{
    protected ErrorMetaDtoSerializer $sut;

    protected function setUp(): void
    {
        $this->setUpClassProperties();

        $this->sut = new ErrorMetaDtoSerializer;

        $this->when();
    }
}