<?php


namespace InstaFetcher\DataAccess\Http\Exception;


use Exception;
use Throwable;

class InstaUserNotFound extends Exception
{
    public function __construct(string $handle)
    {
        parent::__construct("user not found with handle: $handle");
    }
}