<?php


namespace InstaFetcher\DataAccess\Http\Exception;


class TokenNotAuthorised extends TokenException
{
    public function __construct(string $token)
    {
        parent::__construct("token: $token is not authorized");
    }
}