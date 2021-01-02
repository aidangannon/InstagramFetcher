<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DataAccess\Dao\InstaUserDao;


use InstaFetcher\DataAccess\Http\SymfonyHttp\InstaUserSymfonyHttpDao;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IErrorDtoSerializer;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IInstaUserDtoSerializer;
use InstaFetcher\Interfaces\Validation\IFacebookGraphErrorValidator;
use InstaFetcherTests\Unit\GwtTestCase;
use Mockery;
use Mockery\MockInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

abstract class InstaUserDaoTestCase extends GwtTestCase
{

    protected int $appId;
    protected string $appSecret;
    protected string $baseUrl;

    protected InstaUserSymfonyHttpDao $sut;

    /**
     * @var HttpClientInterface|MockInterface
     */
    protected $mockHttpClient;

    /**
     * @var IErrorDtoSerializer|MockInterface
     */
    protected $mockErrorSerializer;

    /**
     * @var IInstaUserDtoSerializer|MockInterface
     */
    protected $mockUserSerializer;

    /**
     * @var ResponseInterface|MockInterface
     */
    protected $mockResponse;

    protected function setUp(): void
    {
        $this->mockHttpClient = Mockery::mock(HttpClientInterface::class);
        $this->mockErrorSerializer = Mockery::mock(IErrorDtoSerializer::class);
        $this->mockUserSerializer = Mockery::mock(IInstaUserDtoSerializer::class);
        $this->mockResponse = Mockery::mock(ResponseInterface::class);

        $this->setUpClassProperties();

        $this->appId = 12345678;
        $this->baseUrl = "https://graph.facebook.com/v9.0/";
        $this->appSecret = "0000";

        $this->sut = new InstaUserSymfonyHttpDao(
            $this->appId,
            $this->appSecret,
            $this->baseUrl,
            $this->mockHttpClient,
            $this->mockErrorSerializer,
            $this->mockUserSerializer
        );

        $this->when();
    }
}