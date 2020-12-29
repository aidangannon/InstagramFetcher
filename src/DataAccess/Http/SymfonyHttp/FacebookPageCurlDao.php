<?php


namespace InstaFetcher\DataAccess\Http\SymfonyHttp;


use InstaFetcher\DataAccess\Dtos\FacebookPagesDto;
use InstaFetcher\DataAccess\Interfaces\Http\Dao\IFacebookPageDao;

class FacebookPageCurlDao implements IFacebookPageDao
{

    public function getInstaAccounts(string $token): FacebookPagesDto
    {
        throw new \BadMethodCallException("not implemented");
    }
}