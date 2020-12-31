<?php


namespace InstaFetcher\DataAccess\Http\Exception\GraphExceptions\Exceptions;


use Exception;
use Throwable;

class GraphException extends Exception
{
    public function __construct()
    {
        parent::__construct("a facebook graph error occurred");
    }
}