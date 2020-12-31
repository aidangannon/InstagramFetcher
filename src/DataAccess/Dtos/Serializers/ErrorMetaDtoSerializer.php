<?php


namespace InstaFetcher\DataAccess\Dtos\Serializers;


use BadMethodCallException;
use InstaFetcher\DataAccess\Dtos\ErrorMetaDataDto;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IErrorMetaDtoSerializer;

class ErrorMetaDtoSerializer implements IErrorMetaDtoSerializer
{

    public function deserialize(array $errorMeta): ErrorMetaDataDto
    {
        throw new BadMethodCallException("not implemented");
    }
}