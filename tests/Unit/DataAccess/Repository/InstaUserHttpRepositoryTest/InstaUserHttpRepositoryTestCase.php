<?php

namespace InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepositoryTest;

use InstaFetcher\DataAccess\Http\Repository\InstaUserHttpRepository;
use InstaFetcher\DataAccess\Interfaces\Http\IFacebookGraphCaller;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class InstaUserHttpRepositoryTestCase extends TestCase
{

    private InstaUserHttpRepository $instaUserRepository;

    /**
     * @var MockObject|IFacebookGraphCaller
     */
    private IFacebookGraphCaller $mockFacebookGraphCaller;

    protected function setUp(): void
    {
        $this->mockFacebookGraphCaller = $this->createMock(IFacebookGraphCaller::class);

        $this->instaUserRepository = new InstaUserHttpRepository($this->mockFacebookGraphCaller);
    }

}
