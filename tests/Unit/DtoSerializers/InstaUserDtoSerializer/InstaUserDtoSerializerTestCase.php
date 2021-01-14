<?php


namespace InstaFetcherTests\Unit\DtoSerializers\InstaUserDtoSerializer;


use InstaFetcher\DataAccess\Dtos\Serializers\InstaUserDtoSerializer;
use InstaFetcherTests\GwtTestCase;

abstract class InstaUserDtoSerializerTestCase extends GwtTestCase
{
    protected InstaUserDtoSerializer $sut;

    protected function setUp(): void
    {
        $this->setUpClassProperties();

        $this->sut = new InstaUserDtoSerializer;

        $this->when();
    }
}