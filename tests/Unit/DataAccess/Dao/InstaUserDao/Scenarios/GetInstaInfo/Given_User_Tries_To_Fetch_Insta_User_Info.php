<?php
declare(strict_types=1);

namespace InstaFetcherTests\Unit\DataAccess\Dao\InstaUserDao\Scenarios\GetInstaInfo;


use Exception;
use InstaFetcher\DataAccess\Dtos\InstaUserDto;
use InstaFetcherTests\Unit\DataAccess\Dao\FacebookPageDao\Scenarios\GetInstaAccounts\Given_User_Tries_To_Fetch_Pages_With_The_Page_Insta_User;
use InstaFetcherTests\Unit\DataAccess\Dao\InstaUserDao\InstaUserDaoTestCase;

/**
 * <u> covers situations: </u>
 * * user wants to fetch insta profile information
 */
abstract class Given_User_Tries_To_Fetch_Insta_User_Info extends InstaUserDaoTestCase
{

    protected string $id="1111";
    protected string $token="0000";

    protected InstaUserDto $user;
    protected Exception $exception;

    public function when()
    {
        try {
            $this->user = $this->sut->getInstaInfo($this->id,$this->token);
        }
        catch(Exception $e) {
            $this->exception = $e;
        }
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_Correct_Url_Is_Called()
    {
        $this->mockHttpClient
            ->shouldHaveReceived(
                "request",
                [
                    'GET',
                    "{$this->baseUrl}{$this->id}?".
                    "fields=id,username,followers_count&".
                    "access_token={$this->token}&appsecret_proof=".hash_hmac('sha256', $this->token, $this->appSecret)
                ]
            );
    }

    /**
     * @doesNotPerformAssertions
     * @test
     */
    public function Then_Response_Code_Must_Be_Retrieved_For_Validation()
    {
        $this->mockResponse
            ->shouldHaveReceived("getStatusCode");
    }
}