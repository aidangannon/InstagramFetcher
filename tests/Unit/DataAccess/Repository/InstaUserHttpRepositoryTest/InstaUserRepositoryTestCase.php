<?php


namespace InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepositoryTest;


use InstaFetcher\DataAccess\Http\Repository\InstaUserHttpRepository;
use InstaFetcher\DataAccess\Interfaces\Http\Dao\IFacebookPageDao;
use InstaFetcher\DataAccess\Interfaces\Http\Dao\IInstaUserDao;
use InstaFetcher\DomainModels\Session\FacebookGraphSessionModel;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\TestResult;

abstract class InstaUserRepositoryTestCase extends TestCase
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

        $this->setUpMocks();

        $this->sut = new InstaUserHttpRepository($this->mockSession,$this->mockPageDao,$this->mockUserDao);

        $this->when();
    }

    public function run(TestResult $result = null): TestResult
    {
        foreach($this->fixtureProvider() as $testFixture){
            $this->initFixture($testFixture);
            $result->run($this);
        }

        return $result;
    }

    public abstract function when();

    public abstract function setUpMocks();

    public abstract function fixtureProvider(): array;

    public abstract function initFixture(array $data);

    protected function tearDown(): void
    {
        Mockery::close();
    }

}