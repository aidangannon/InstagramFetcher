<?php


namespace InstaFetcherTests\Unit\DataAccess\Dao\FacebookPageDao\Scenarios\GetInstaAccounts;


use Exception;
use InstaFetcher\DataAccess\Dtos\FacebookPagesDto;
use InstaFetcherTests\Unit\DataAccess\Dao\FacebookPageDao\FacebookPageDaoTestCase;

abstract class Given_User_Tries_To_Fetch_Pages_With_The_Page_Insta_User extends FacebookPageDaoTestCase
{
    protected string $token;
    protected string $appSecretProof;
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
                    "https://graph.facebook.com/v9.0/me/accounts?fields=instagram_business_account{username,followers_count}&access_token=$this->token&appsecret_proof=$this->appSecretProof"
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