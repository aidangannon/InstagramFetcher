<?php


namespace InstaFetcherTests\Integration\DataAccessLayer\InstaUserTests\Scenarios\GetUserById;


use Exception;
use InstaFetcher\DomainModels\InstaUser\InstaUserModel;
use InstaFetcherTests\Integration\DataAccessLayer\InstaUserTests\InstaUserDataAccessIntegrationTestCase;

abstract class Given_User_Tries_To_Get_Insta_User_By_Id extends InstaUserDataAccessIntegrationTestCase
{
    protected string $id;
    protected Exception $exception;
    protected InstaUserModel $user;

    public function when()
    {
        try{
            $this->user = $this->sut->get($this->id);
        }
        catch(Exception $e){
            $this->exception = $e;
        }
    }
}