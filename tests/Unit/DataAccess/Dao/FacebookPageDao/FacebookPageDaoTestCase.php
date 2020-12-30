<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DataAccess\Dao\FacebookPageDao;


use InstaFetcher\DataAccess\Http\Exception\GraphExceptions\FacebookGraphErrorValidator;
use InstaFetcher\DataAccess\Http\SymfonyHttp\FacebookPageSymfonyHttpDao;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IErrorDtoSerializer;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IFacebookPageDtoSerializer;
use InstaFetcherTests\Unit\GwtTestCase;
use Mockery;
use Mockery\MockInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

abstract class FacebookPageDaoTestCase extends GwtTestCase
{
    /**
     * @var ResponseInterface|MockInterface
     */
    protected $mockResponse;
    /**
     * @var HttpClientInterface|MockInterface
     */
    protected $mockHttpClient;
    /**
     * @var FacebookGraphErrorValidator|MockInterface
     */
    protected $mockErrorValidator;
    /**
     * @var IErrorDtoSerializer|MockInterface
     */
    protected $mockErrorSerializer;
    /**
     * @var IFacebookPageDtoSerializer|MockInterface
     */
    protected $mockPageSerializer;

    protected FacebookPageSymfonyHttpDao $sut;

    protected function setUp(): void
    {
        $this->mockResponse = Mockery::mock(ResponseInterface::class);
        $this->mockHttpClient = Mockery::mock(HttpClientInterface::class);
        $this->mockErrorValidator = Mockery::mock(FacebookGraphErrorValidator::class);
        $this->mockErrorSerializer = Mockery::mock(IErrorDtoSerializer::class);
        $this->mockPageSerializer = Mockery::mock(IFacebookPageDtoSerializer::class);

        $this->setUpMocks();

        $this->sut = new FacebookPageSymfonyHttpDao($this->mockHttpClient,$this->mockErrorValidator,$this->mockErrorSerializer,$this->mockPageSerializer);

        $this->when();
    }

}