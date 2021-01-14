<?php


namespace InstaFetcherTests\Integration\DataAccessLayer\InstaUserTests\Scenarios\GetUserByHandle;


use Exception;
use InstaFetcher\DomainModels\InstaUser\InstaUserModel;
use InstaFetcherTests\Integration\DataAccessLayer\InstaUserTests\InstaUserDataAccessIntegrationTestCase;

abstract class Given_User_Tries_To_Get_Insta_User_By_Handle extends InstaUserDataAccessIntegrationTestCase
{
    protected string $handle;
    protected Exception $exception;
    protected InstaUserModel $user;

    public function when()
    {
        try{
            $this->user = $this->sut->getByHandle($this->handle);
        }
        catch(Exception $e){
            $this->exception = $e;
        }
    }
}