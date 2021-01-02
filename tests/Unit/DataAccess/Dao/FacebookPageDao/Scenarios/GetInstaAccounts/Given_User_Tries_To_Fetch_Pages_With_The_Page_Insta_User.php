<?php


namespace InstaFetcherTests\Unit\DataAccess\Dao\FacebookPageDao\Scenarios\GetInstaAccounts;


use Exception;
use InstaFetcher\DataAccess\Dtos\FacebookPagesDto;
use InstaFetcherTests\Unit\DataAccess\Dao\FacebookPageDao\FacebookPageDaoTestCase;

/**
 * <u> covers situations: </u>
 * * user wants to get list of all insta users
 * * user wants to find insta user by username
 * * user wants to get list of all users pages with id and their insta account
 */
abstract class Given_User_Tries_To_Fetch_Pages_With_The_Page_Insta_User extends FacebookPageDaoTestCase
{
    protected string $token="1111";
    protected Exception $exception;
    protected FacebookPagesDto $pages;

    public function when()
    {
        try {
            $this->pages = $this->sut->getInstaAccounts($this->token);
        }
        catch(Exception $e){
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
                    "{$this->baseUrl}me/accounts?".
                    "fields=instagram_business_account{username,followers_count}&".
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