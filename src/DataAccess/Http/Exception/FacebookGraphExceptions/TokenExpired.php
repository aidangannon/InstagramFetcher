<?php


namespace InstaFetcher\DataAccess\Http\Exception\FacebookGraphExceptions;


use Exception;
use Throwable;

class TokenExpired extends Exception
{
    public function __construct(string $token)
    {
        parent::__construct("token: $token was invalid");
    }
}