<?php


namespace InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\Scenarios\GetUserByHandle;


use Exception;
use InstaFetcher\DomainModels\InstaUser\InstaUserModel;
use InstaFetcherTests\Unit\DataAccess\Repository\InstaUserHttpRepository\InstaUserRepositoryTestCase;

abstract class Given_User_Tries_To_Get_Insta_User_By_Handle extends InstaUserRepositoryTestCase
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
}