<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DataAccess\Dao\FacebookPageDao\Scenarios\GetInstaAccounts\When;


use InstaFetcherTests\Unit\DataAccess\Dao\FacebookPageDao\Scenarios\GetInstaAccounts\Given_User_Tries_To_Fetch_Pages_With_The_Page_Insta_User;
use Symfony\Component\HttpClient\Exception\TransportException;

class When_Offline_Test extends Given_User_Tries_To_Fetch_Pages_With_The_Page_Insta_User
{
    public function setUpClassProperties()
    {
        $this->mockResponse
            ->shouldReceive("getStatusCode")
            ->andThrow(TransportException::class);
    }



    /**
     * @test
     */
    public function Then_TransportException_Must_Be_Thrown()
    {
        self::assertInstanceOf(TransportException::class,$this->exception);
    }
}