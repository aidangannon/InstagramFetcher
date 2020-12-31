<?php


namespace InstaFetcher\DataAccess\Dtos\Serializers\Exception;


use Exception;
use Throwable;

abstract class DtoDeserializeException extends Exception
{
    public function __construct(string $dto)
    {
        parent::__construct("{$dto} cannot be deserialized");
    }
}