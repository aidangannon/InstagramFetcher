<?php


namespace InstaFetcher\DataAccess\Dtos\Serializers\Exception;


class InstaUserDtoDeserializationError extends DtoDeserializeException
{
    public function __construct()
    {
        parent::__construct("insta user");
    }
}