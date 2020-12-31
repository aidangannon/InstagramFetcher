<?php


namespace InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository;


use InstaFetcher\DataAccess\Http\Repository\InstaUserHttpRepository;
use InstaFetcher\Interfaces\DataAccess\Http\Dao\IFacebookPageDao;
use InstaFetcher\Interfaces\DataAccess\Http\Dao\IInstaUserDao;
use InstaFetcher\DomainModels\Session\FacebookGraphSessionModel;
use InstaFetcherTests\Unit\GwtTestCase;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\TestResult;

abstract class InstaUserRepositoryTestCase extends GwtTestCase
{

    /**
     * @var FacebookGraphSessionModel|MockInterface
     */
    protected $mockSession;

    /**
     * @var IFacebookPageDao|MockInterface
     */
    protected $mockPageDao;

    /**
     * @var IInstaUserDao|MockInterface
     */
    protected $mockUserDao;

    protected InstaUserHttpRepository $sut;

    protected function setUp(): void
    {
        $this->mockUserDao = Mockery::mock(IInstaUserDao::class);
        $this->mockPageDao = Mockery::mock(IFacebookPageDao::class);
        $this->mockSession = Mockery::mock(FacebookGraphSessionModel::class);

        $this->setUpClassProperties();

        $this->sut = new InstaUserHttpRepository($this->mockSession,$this->mockPageDao,$this->mockUserDao);

        $this->when();
    }

}