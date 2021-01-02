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
            $user = $this->sut->getInstaInfo($this->id,$this->token);
        }
        catch(Exception $e) {
            $this->exception = $e;
        }
    }
}