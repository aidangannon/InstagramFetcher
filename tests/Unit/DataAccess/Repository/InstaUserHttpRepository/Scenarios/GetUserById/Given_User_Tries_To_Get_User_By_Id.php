<?php


namespace InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserById;


use Exception;
use InstaFetcher\DomainModels\InstaUser\InstaUserModel;
use InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\InstaUserRepositoryTestCase;

/**
 * <u> covers situations: </u>
 * * when user wants to get insta profile
 */
abstract class Given_User_Tries_To_Get_User_By_Id extends InstaUserRepositoryTestCase
{
    protected string $token;
    protected string $id;
    protected Exception $exception;
    protected InstaUserModel $user;

    public function when()
    {
        try {
            $this->user = $this->sut->get($this->id);
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
    public function Then_Insta_User_Should_Be_Fetched_With_Correct_Args()
    {
        $this->mockUserDao
            ->shouldHaveReceived("getInstaInfo", [$this->id,$this->token]);
    }
}