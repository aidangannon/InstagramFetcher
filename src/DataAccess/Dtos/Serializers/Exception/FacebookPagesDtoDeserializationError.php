<?php


namespace InstaFetcher\DataAccess\Dtos\Serializers\Exception;


class FacebookPagesDtoDeserializationError extends DtoDeserializeException
{
    public function __construct()
    {
        parent::__construct("facebook pages dto");
    }
}