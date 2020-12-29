<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepositoryTest\GetUserByHandle;


use Exception;
use InstaFetcher\DataAccess\Dtos\FacebookPageDto;
use InstaFetcher\DataAccess\Dtos\FacebookPagesDto;
use InstaFetcher\DataAccess\Dtos\InstaUserDto;
use InstaFetcher\DataAccess\Http\Exception\InstaUserNotFound;
use InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepositoryTest\InstaUserRepositoryTestCase;
use PHPUnit\Framework\TestCase;

class When_Handle_Is_Invalid_Test extends InstaUserRepositoryTestCase
{

    private string $token;
    private string $handle;
    private FacebookPagesDto $pages;

    private Exception $exception;

    public function when()
    {
        try {
            $this->sut->getByHandle($this->handle);
        }
        catch(Exception $e){
            $this->exception = $e;
        }
    }

    public function setUpMocks()
    {
        $this->mockSession
            ->shouldReceive("getToken")
            ->andReturns($this->token);
        $this->mockPageDao
            ->shouldReceive("getInstaAccounts")
            ->with($this->token)
            ->andReturns($this->pages);
    }

    public function fixtureProvider(): array
    {
        return [
            [
                "token"=>"00000",
                "handle"=>"example_handle",
                "pages"=>new FacebookPagesDto(
                    [
                        new FacebookPageDto(
                            "11111",
                            new InstaUserDto(
                                "22222",
                                100,
                                "test1"
                            )
                        )
                    ]
                )
            ],
            [
                "token"=>"00000",
                "handle"=>"example_handle",
                "pages"=>new FacebookPagesDto(
                    [
                        new FacebookPageDto(
                            "11111",
                            new InstaUserDto(
                                "22222",
                                100,
                                "test1"
                            )
                        ),
                        new FacebookPageDto(
                            "33333",
                            new InstaUserDto(
                                "444444",
                                100,
                                "test2"
                            )
                        )
                    ]
                )
            ]
        ];
    }

    public function initFixture(array $data)
    {
        $this->token=$data["token"];
        $this->handle=$data["handle"];
        $this->pages=$data["pages"];
    }
    
}