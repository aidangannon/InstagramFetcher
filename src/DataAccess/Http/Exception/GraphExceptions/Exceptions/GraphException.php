<?php


namespace InstaFetcher\DataAccess\Http\Exception\GraphExceptions\Exceptions;


use Exception;
use InstaFetcher\DataAccess\Dtos\ErrorDto;
use Throwable;

class GraphException extends Exception
{

    private ErrorDto $graphError;

    public function __construct(ErrorDto $graphError)
    {
        parent::__construct("a graph error occurred");
        $this->graphError = $graphError;
    }

    public function getGraphError(): ErrorDto
    {
        return $this->graphError;
    }
}