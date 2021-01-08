<?php
declare(strict_types=1);

namespace InstaFetcher\DataAccess\Dtos\Serializers;


use BadMethodCallException;
use InstaFetcher\DataAccess\Dtos\ErrorDto;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IErrorDtoSerializer;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IErrorMetaDtoSerializer;

class ErrorDtoSerializer implements IErrorDtoSerializer
{
    private IErrorMetaDtoSerializer $errorMetaSerializer;

    public function __construct(IErrorMetaDtoSerializer $errorMetaSerializer)
    {
        $this->errorMetaSerializer = $errorMetaSerializer;
    }

    public function deserialize(array $error): ErrorDto
    {
        throw new BadMethodCallException("not implemented");
    }
}