<?php

namespace InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepositoryTest;

use InstaFetcher\DataAccess\Http\Repository\InstaUserHttpRepository;
use InstaFetcher\DataAccess\Interfaces\Http\IFacebookGraphCaller;
use InstaFetcher\DomainModels\Session\FacebookGraphSessionModel;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\TestResult;

abstract class InstaUserHttpRepositoryTestCase extends TestCase
{

    protected InstaUserHttpRepository $instaUserRepository;

    /**
     * @var MockObject|IFacebookGraphCaller
     */
    protected IFacebookGraphCaller $mockFacebookGraphCaller;

    /**
     * @var FacebookGraphSessionModel|MockObject
     */
    protected FacebookGraphSessionModel $mockInstaSession;

    protected function setUp(): void
    {
        $this->mockFacebookGraphCaller = $this->createMock(IFacebookGraphCaller::class);

        $this->instaUserRepository = new InstaUserHttpRepository($this->mockFacebookGraphCaller,$this->mockInstaSession);
    }

    public function run(TestResult $result = null): TestResult
    {
        $data = $this->testFixture();

        foreach($data as $testCaseData){
            $this->initFixture($testCaseData);
            $result->run($this);
        }

        return $result;
    }

    abstract function testFixture(): array;

    abstract function initFixture(array $testCaseData);

}
