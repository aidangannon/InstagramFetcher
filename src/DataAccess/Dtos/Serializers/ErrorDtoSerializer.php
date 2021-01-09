<?php
declare(strict_types=1);

namespace InstaFetcher\DataAccess\Dtos\Serializers;


use InstaFetcher\DataAccess\Dtos\ErrorDto;
use InstaFetcher\DataAccess\Dtos\Serializers\Exception\ErrorDtoDeserializationError;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IErrorDtoSerializer;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IErrorMetaDtoSerializer;
use TypeError;

class ErrorDtoSerializer implements IErrorDtoSerializer
{
    private IErrorMetaDtoSerializer $errorMetaSerializer;

    public function __construct(IErrorMetaDtoSerializer $errorMetaSerializer)
    {
        $this->errorMetaSerializer = $errorMetaSerializer;
    }

    public function deserialize(array $error): ErrorDto
    {
        try {
            if (isset($error[ErrorDto::ERROR_FIELD])) {
                $errorMeta = $this->errorMetaSerializer->deserialize($error[ErrorDto::ERROR_FIELD]);
                return new ErrorDto($errorMeta);
            } else {
                throw new ErrorDtoDeserializationError();
            }
        }
        catch(TypeError $e){
            throw new ErrorDtoDeserializationError();
        }
    }
}