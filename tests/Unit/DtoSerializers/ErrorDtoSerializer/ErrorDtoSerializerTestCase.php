<?php


namespace InstaFetcherTests\Unit\DtoSerializers\ErrorDtoSerializer;


use InstaFetcher\DataAccess\Dtos\Serializers\ErrorDtoSerializer;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IErrorMetaDtoSerializer;
use InstaFetcherTests\GwtTestCase;
use Mockery;
use Mockery\MockInterface;

abstract class ErrorDtoSerializerTestCase extends GwtTestCase
{
    protected ErrorDtoSerializer $sut;

    /**
     * @var MockInterface|IErrorMetaDtoSerializer
     */
    protected $mockErrorMetaSerializer;

    protected function setUp(): void
    {
        $this->mockErrorMetaSerializer = Mockery::mock(IErrorMetaDtoSerializer::class);

        $this->setUpClassProperties();

        $this->sut = new ErrorDtoSerializer($this->mockErrorMetaSerializer);

        $this->when();
    }
}