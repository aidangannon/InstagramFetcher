<?php


namespace InstaFetcher\DataAccess\Interfaces\Http\Dao;


use InstaFetcher\DataAccess\Dtos\InstaUserDto;

interface IInstaUserDao
{
    /**
     * gets insta data from id
     * returns array from json response
     */
    public function getInstaInfo(string $instaId, string $token): InstaUserDto;
}