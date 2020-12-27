<?php


namespace InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepositoryTest\GetUserByHandle;


use InstaFetcher\DataAccess\DTOs\FacebookPageDTO;
use InstaFetcher\DataAccess\Http\Curl\FacebookGraphCaller;
use InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepositoryTest\Given_User_Gets_Insta_User_By_Handle;
use InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepositoryTest\InstaUserHttpRepositoryTestCase;
use PHPUnit\Framework\TestResult;

class When_Handle_Is_Invalid_Test extends Given_User_Gets_Insta_User_By_Handle
{

    private string $token;
    private string $handle;
    private array $getInstaAccountsResponse;

    protected function setUp(): void
    {
        $this->mockFacebookGraphCaller
            ->method("get_instaAccounts")
            ->willReturn($this->getInstaAccountsResponse);
        $mockPage1 = $this
            ->createMock(FacebookPageDTO::class);
        $mockPage1->method("hydrate")->willReturn($mockPage1);

        parent::setUp();
    }

    function testFixture(): array
    {
        return [
            [
                "token"=>"example_token_1",
                "handle"=>"example_handle_1",
                "getInstaAccountsResponse"
            ]
        ];
    }

    function initFixture(array $testCaseData)
    {
        $this->token = $testCaseData["token"];
        $this->handle = $testCaseData["handle"];
        $this->getInstaAccountsResponse = $testCaseData["getInstaAccountsResponse"];
    }
}