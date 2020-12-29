<?php


namespace InstaFetcher\DataAccess\Http\Curl;


use InstaFetcher\DataAccess\Dtos\InstaUserDto;
use InstaFetcher\DataAccess\Interfaces\Http\Dao\IInstaUserDao;

class InstaUserCurlDao implements IInstaUserDao
{

    public function get_instaInfo(string $instaId, string $token): InstaUserDto
    {
        throw new \BadMethodCallException("not implemented");
    }
}