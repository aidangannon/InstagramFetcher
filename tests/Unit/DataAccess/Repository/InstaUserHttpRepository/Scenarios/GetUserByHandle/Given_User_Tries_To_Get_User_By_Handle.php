<?php


namespace InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserByHandle;


use Exception;
use InstaFetcher\DomainModels\InstaUser\InstaUserModel;
use InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\InstaUserRepositoryTestCase;

/**
 * <u> covers situations: </u>
 * * when user wants to search for specific insta user by handle once and save their id
 */
abstract class Given_User_Tries_To_Get_User_By_Handle extends InstaUserRepositoryTestCase
{
    protected string $token;
    protected string $handle;
    protected Exception $exception;
    protected InstaUserModel $user;

    public function when()
    {
        try {
            $this->user = $this->sut->getByHandle($this->handle);
        }
        catch(Exception $e){
            $this->exception = $e;
        }
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_Token_Should_Be_Received_From_Facebook_Session()
    {
        $this->mockSession
            ->shouldHaveReceived("getToken");
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_Insta_Accounts_Should_Be_Fetched_From_Session_Token()
    {
        $this->mockPageDao
            ->shouldHaveReceived("getInstaAccounts")
            ->once();
        $this->mockPageDao
            ->shouldHaveReceived("getInstaAccounts", [$this->token]);
    }
}