<?php


namespace InstaFetcher\Interfaces\DataAccess\Http\Dao;


use InstaFetcher\DataAccess\Dtos\FacebookPagesDto;

interface IFacebookPageDao
{
    /**
     * gets all facebook page's instagram account for the authorized user
     * returns dto from json response
     */
    public function getInstaAccounts(string $token): FacebookPagesDto;
}