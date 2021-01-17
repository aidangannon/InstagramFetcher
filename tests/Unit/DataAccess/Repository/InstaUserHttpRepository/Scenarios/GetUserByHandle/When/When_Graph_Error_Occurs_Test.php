<?php

namespace InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserByHandle\When;


use InstaFetcher\DataAccess\Dtos\ErrorDto;
use InstaFetcher\DataAccess\Dtos\ErrorMetaDataDto;
use InstaFetcher\DataAccess\Http\Exception\GraphExceptions\Exceptions\GraphException;
use InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserByHandle\Given_User_Tries_To_Get_Insta_User_By_Handle;

/**
 * @testdox Given User Tries To Get Insta User By Handle, When Graph Error Occurs (DataAccess/Repository)
 */
class When_Graph_Error_Occurs_Test extends Given_User_Tries_To_Get_Insta_User_By_Handle
{
    protected GraphException $tokenException;

    public function setUpClassProperties()
    {
        $this->mockSession
            ->shouldReceive("getToken")
            ->andReturns($this->token);
        $this->mockPageDao
            ->shouldReceive("getInstaAccounts")
            ->with($this->token)
            ->andThrow($this->tokenException);
    }

    public function fixtureProvider(): array
    {
        return [
            [
                "token" => "00000",
                "handle" => "example_handle",
                "tokenException" => new GraphException(new ErrorDto(new ErrorMetaDataDto("OAuthException",190,0)))
            ]
        ];
    }

    public function initFixture(array $data)
    {
        $this->token = $data["token"];
        $this->handle = $data["handle"];
        $this->tokenException = $data["tokenException"];
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_Token_Was_Received_From_Facebook_Session()
    {
        $this->mockSession
            ->shouldHaveReceived("getToken");
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_Insta_Accounts_Were_Attempted_To_Be_Fetched()
    {
        $this->mockPageDao
            ->shouldHaveReceived("getInstaAccounts")
            ->once();
        $this->mockPageDao
            ->shouldHaveReceived("getInstaAccounts", [$this->token]);
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_User_Info_Was_Not_Fetched_Via_Id()
    {
        $this->mockUserDao
            ->shouldNotHaveReceived("getInstaInfo");
    }

    /**
     * @test
     */
    public function Then_Graph_Error_Occurs()
    {
        self::assertEquals($this->tokenException,$this->exception);
    }
}