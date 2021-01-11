<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DtoSerializers\FacebookPagesDtoSerializer;


use InstaFetcher\DataAccess\Dtos\Serializers\FacebookPagesDtoSerializer;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IFacebookPageDtoSerializer;
use InstaFetcherTests\Unit\GwtTestCase;
use Mockery;
use Mockery\MockInterface;

abstract class FacebookPagesDtoSerializerTestCase extends GwtTestCase
{
    protected FacebookPagesDtoSerializer $sut;

    /**
     * @var MockInterface|IFacebookPageDtoSerializer
     */
    protected $mockFacebookPageDtoSerializer;

    protected function setUp(): void
    {
        $this->mockFacebookPageDtoSerializer = Mockery::mock(IFacebookPageDtoSerializer::class);

        $this->setUpClassProperties();

        $this->sut = new FacebookPagesDtoSerializer($this->mockFacebookPageDtoSerializer);

        $this->when();
    }
}