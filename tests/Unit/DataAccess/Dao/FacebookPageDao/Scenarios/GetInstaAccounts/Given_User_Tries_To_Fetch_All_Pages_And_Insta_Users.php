<?php


namespace InstaFetcherTests\Unit\DataAccess\Dao\FacebookPageDao\Scenarios\GetInstaAccounts;


use Exception;
use InstaFetcher\DataAccess\Dtos\FacebookPagesDto;
use InstaFetcherTests\Unit\DataAccess\Dao\FacebookPageDao\FacebookPageDaoTestCase;

abstract class Given_User_Tries_To_Fetch_All_Pages_And_Insta_Users extends FacebookPageDaoTestCase
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
}