<?php


namespace InstaFetcher\DataAccess\Dtos\Serializers\Exception;


class ErrorDtoDeserializationError extends DtoDeserializeException
{
    public function __construct()
    {
        parent::__construct("error dto");
    }
}