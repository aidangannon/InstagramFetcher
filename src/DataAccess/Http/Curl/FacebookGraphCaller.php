<?php

namespace InstaFetcher\DataAccess\Http\Curl;

use InstaFetcher\DataAccess\Interfaces\Http\IFacebookGraphCaller;

/**
 * http-curl graph API communicator
 */
class FacebookGraphCaller implements IFacebookGraphCaller
{

    public function get_instaInfo(string $instaId, string $token): array
    {
        throw new \BadMethodCallException("not implemented");
    }

    public function get_exchangeToken(string $code): array
    {
        throw new \BadMethodCallException("not implemented");
    }

    public function get_debugToken(string $token): array
    {
        throw new \BadMethodCallException("not implemented");
    }

    public function delete_permissions(string $token): array
    {
        throw new \BadMethodCallException("not implemented");
    }

    public function get_permissions(string $token): array
    {
        throw new \BadMethodCallException("not implemented");
    }

    public function get_instaAudienceCountryInsights(string $instaId): array
    {
        throw new \BadMethodCallException("not implemented");
    }

    public function get_instaAudienceGenderAgeInsights(string $instaId): array
    {
        throw new \BadMethodCallException("not implemented");
    }

    public function get_instaAccounts(string $token): array
    {
        throw new \BadMethodCallException("not implemented");
    }
}