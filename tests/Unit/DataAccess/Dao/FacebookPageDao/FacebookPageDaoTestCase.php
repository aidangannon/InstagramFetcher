<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DataAccess\Dao\FacebookPageDao;


use InstaFetcher\DataAccess\Http\SymfonyHttp\FacebookPageSymfonyHttpDao;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IErrorDtoSerializer;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IFacebookPagesDtoSerializer;
use InstaFetcherTests\GwtTestCase;
use Mockery;
use Mockery\MockInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

abstract class FacebookPageDaoTestCase extends GwtTestCase
{
    protected int $appId;
    protected string $appSecret;
    protected string $baseUrl;
    /**
     * @var ResponseInterface|MockInterface
     */
    protected $mockResponse;
    /**
     * @var HttpClientInterface|MockInterface
     */
    protected $mockHttpClient;
    /**
     * @var IErrorDtoSerializer|MockInterface
     */
    protected $mockErrorSerializer;
    /**
     * @var IFacebookPagesDtoSerializer|MockInterface
     */
    protected $mockPagesSerializer;

    protected FacebookPageSymfonyHttpDao $sut;

    protected function setUp(): void
    {
        $this->mockResponse = Mockery::mock(ResponseInterface::class);
        $this->mockHttpClient = Mockery::mock(HttpClientInterface::class);
        $this->mockErrorSerializer = Mockery::mock(IErrorDtoSerializer::class);
        $this->mockPagesSerializer = Mockery::mock(IFacebookPagesDtoSerializer::class);

        $this->appId = 12345678;
        $this->baseUrl = "https://graph.facebook.com/v9.0/";
        $this->appSecret = "0000";

        $this->setUpClassProperties();

        $this->sut = new FacebookPageSymfonyHttpDao(
            $this->appId,
            $this->appSecret,
            $this->baseUrl,
            $this->mockHttpClient,
            $this->mockErrorSerializer,
            $this->mockPagesSerializer
        );

        $this->when();
    }

}