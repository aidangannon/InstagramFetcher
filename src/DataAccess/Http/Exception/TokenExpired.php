<?php


namespace InstaFetcher\DataAccess\Http\Exception;


class TokenExpired extends TokenException
{
    public function __construct(string $token)
    {
        parent::__construct("token: $token has expired");
    }
}