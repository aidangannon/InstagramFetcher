<?php


namespace InstaFetcher\DataAccess\Interfaces\Http\Dao;


use InstaFetcher\DataAccess\Dtos\FacebookPagesDto;

interface IFacebookPageDao
{
    /**
     * gets all facebook page's instagram account for the authorized user
     * returns array from json response
     */
    public function getInstaAccounts(string $token): FacebookPagesDto;
}