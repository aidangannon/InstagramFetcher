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

abstract class InstaUserDaoTestCase extends GwtTestCase
{

    protected InstaUserSymfonyHttpDao $sut;

    /**
     * @var HttpClientInterface|MockInterface
     */
    protected $mockHttpClient;

    /**
     * @var IFacebookGraphErrorValidator|MockInterface
     */
    protected $mockErrorValidator;

    /**
     * @var IErrorDtoSerializer|MockInterface
     */
    protected $mockErrorSerializer;

    /**
     * @var IInstaUserDtoSerializer|MockInterface
     */
    protected $mockUserSerializer;

    protected function setUp(): void
    {
        $this->mockHttpClient = Mockery::mock(HttpClientInterface::class);
        $this->mockErrorValidator = Mockery::mock(IFacebookGraphErrorValidator::class);
        $this->mockErrorSerializer = Mockery::mock(IErrorDtoSerializer::class);
        $this->mockUserSerializer = Mockery::mock(IInstaUserDtoSerializer::class);

        $this->setUpClassProperties();

        $this->sut = new InstaUserSymfonyHttpDao(
            $this->mockHttpClient,
            $this->mockErrorValidator,
            $this->mockErrorSerializer,
            $this->mockUserSerializer
        );

        $this->when();
    }
}