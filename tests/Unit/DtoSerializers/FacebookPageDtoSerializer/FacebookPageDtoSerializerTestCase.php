<?php


namespace InstaFetcherTests\Unit\DtoSerializers\FacebookPageDtoSerializer;


use InstaFetcher\DataAccess\Dtos\Serializers\FacebookPageDtoSerializer;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IInstaUserDtoSerializer;
use InstaFetcherTests\Unit\GwtTestCase;
use Mockery;
use Mockery\MockInterface;

abstract class FacebookPageDtoSerializerTestCase extends GwtTestCase
{
    protected FacebookPageDtoSerializer $sut;

    /**
     * @var MockInterface|IInstaUserDtoSerializer
     */
    protected $mockInstaUserDtoSerializer;

    protected function setUp(): void
    {
        $this->mockInstaUserDtoSerializer = Mockery::mock(IInstaUserDtoSerializer::class);

        $this->setUpClassProperties();

        $this->sut = new FacebookPageDtoSerializer($this->mockInstaUserDtoSerializer);

        $this->when();
    }
}