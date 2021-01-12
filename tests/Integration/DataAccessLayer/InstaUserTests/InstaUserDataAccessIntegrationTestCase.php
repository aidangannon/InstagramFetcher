<?php


namespace InstaFetcherTests\Integration\DataAccessLayer\InstaUserTests;


use InstaFetcher\DataAccess\Dtos\Serializers\ErrorDtoSerializer;
use InstaFetcher\DataAccess\Dtos\Serializers\ErrorMetaDtoSerializer;
use InstaFetcher\DataAccess\Dtos\Serializers\FacebookPageDtoSerializer;
use InstaFetcher\DataAccess\Dtos\Serializers\FacebookPagesDtoSerializer;
use InstaFetcher\DataAccess\Dtos\Serializers\InstaUserDtoSerializer;
use InstaFetcher\DataAccess\Http\Repository\InstaUserHttpRepository;
use InstaFetcher\DataAccess\Http\SymfonyHttp\FacebookPageSymfonyHttpDao;
use InstaFetcher\DataAccess\Http\SymfonyHttp\InstaUserSymfonyHttpDao;
use InstaFetcher\DomainModels\Session\FacebookGraphSessionModel;
use InstaFetcherTests\GwtTestCase;
use Mockery;
use Mockery\MockInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

abstract class InstaUserDataAccessIntegrationTestCase extends GwtTestCase
{

    /**
     * @var FacebookGraphSessionModel|MockInterface
     */
    protected $mockSession;
    /**
     * @var HttpClientInterface|MockInterface
     */
    protected $mockHttpClient;
    /**
     * @var ResponseInterface|MockInterface
     */
    protected $mockResponse;

    protected const TEST_ACCESS_TOKEN="testUserToken";
    protected const TEST_APP_ID="12223334444";
    protected const TEST_APP_SECRET="testAppSecret";
    protected const TEST_BASE_URL="https://graph.facebook.com/v9.0/";

    protected InstaUserHttpRepository $sut;

    protected function setUp(): void
    {
        $this->mockSession = Mockery::mock(FacebookGraphSessionModel::class);
        $this->mockSession
            ->shouldReceive("getToken")
            ->andReturns(self::TEST_ACCESS_TOKEN);
        $this->mockResponse = Mockery::mock(ResponseInterface::class);
        $this->mockHttpClient = Mockery::mock(HttpClientInterface::class);

        $this->setUpClassProperties();

        $this->mockHttpClient
            ->shouldReceive("request")
            ->andReturns($this->mockResponse);

        $this->sut = new InstaUserHttpRepository(
            $this->mockSession,
            new FacebookPageSymfonyHttpDao(
                self::TEST_APP_ID,
                self::TEST_APP_SECRET,
                self::TEST_BASE_URL,
                $this->mockHttpClient,
                new ErrorDtoSerializer(
                    new ErrorMetaDtoSerializer()
                ),
                new FacebookPagesDtoSerializer(
                    new FacebookPageDtoSerializer(
                        new InstaUserDtoSerializer()
                    )
                )
            ),
            new InstaUserSymfonyHttpDao(
                self::TEST_APP_ID,
                self::TEST_APP_SECRET,
                self::TEST_BASE_URL,
                $this->mockHttpClient,
                new ErrorDtoSerializer(
                    new ErrorMetaDtoSerializer()
                ),
                new InstaUserDtoSerializer()
            )
        );

        $this->when();
    }
}