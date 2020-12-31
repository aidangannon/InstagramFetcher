<?php


namespace InstaFetcher\DataAccess\Http\SymfonyHttp;


use InstaFetcher\DataAccess\Dtos\InstaUserDto;
use InstaFetcher\Interfaces\DataAccess\Http\Dao\IInstaUserDao;

class InstaUserSymfonyHttpDao implements IInstaUserDao
{

    public function getInstaInfo(string $instaId, string $token): InstaUserDto
    {
        throw new \BadMethodCallException("not implemented");
    }
}