<?php


namespace InstaFetcher\DataAccess\Interfaces\Http;

use InstaFetcher\DomainModels\Session\InstaSession;

/**
 * generic http graph API communicator
 *
 * can be used to change to // curl // guzzle // symfony-http // php-sdk
 */
interface IFacebookGraphCaller
{
    /**
     * gets insta data by iterating through and inspecting each fb page (slower)
     * returns array from json response
     */
    public function get_instaInfoFromFbUser(string $instaHandle, string $token): array;

    /**
     * gets insta data from id
     * returns array from json response
     */
    public function get_instaInfo(string $instaId, string $token): array;

    /**
     * exchanges auth code for long lived token
     * returns array from json response
     */
    public function get_exchangeToken(string $code): array;

    /**
     * inspects user token
     * returns array from json response
     */
    public function get_debugToken(string $token): array;

    /**
     * de-auths user token
     * returns array from json response
     */
    public function delete_permissions(string $token): array;

    /**
     * get permissions assigned to fb user
     * returns array from json response
     */
    public function get_permissions(string $token): array;

    /**
     * gets the number of followers in each country
     * returns array from json response
     */
    public function get_instaAudienceCountryInsights(string $instaId): array;

    /**
     * gets the number of followers of a specific age range and gender
     * returns array from json response
     */
    public function get_instaAudienceGenderAgeInsights(string $instaId): array;
}