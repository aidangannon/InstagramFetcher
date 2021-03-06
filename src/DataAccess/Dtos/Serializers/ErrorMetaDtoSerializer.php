<?php


namespace InstaFetcher\DataAccess\Dtos\Serializers;


use InstaFetcher\DataAccess\Dtos\ErrorMetaDataDto;
use InstaFetcher\DataAccess\Dtos\Serializers\Exception\ErrorDtoDeserializationError;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IErrorMetaDtoSerializer;
use TypeError;

class ErrorMetaDtoSerializer implements IErrorMetaDtoSerializer
{

    public function deserialize(array $errorMeta): ErrorMetaDataDto
    {

        try {
            if (
                (isset($errorMeta[ErrorMetaDataDto::TYPE_FIELD])) &&
                (isset($errorMeta[ErrorMetaDataDto::CODE_FIELD])) &&
                (isset($errorMeta[ErrorMetaDataDto::MESSAGE_FIELD])) &&
                (isset($errorMeta[ErrorMetaDataDto::SUB_CODE_FIELD]))
            ) {
                $type = $errorMeta[ErrorMetaDataDto::TYPE_FIELD];
                $code = $errorMeta[ErrorMetaDataDto::CODE_FIELD];
                $message = $errorMeta[ErrorMetaDataDto::MESSAGE_FIELD];
                $subCode = $errorMeta[ErrorMetaDataDto::SUB_CODE_FIELD];
                return new ErrorMetaDataDto($type, $code, $message, $subCode);
            }
            elseif (
                (isset($errorMeta[ErrorMetaDataDto::TYPE_FIELD])) &&
                (isset($errorMeta[ErrorMetaDataDto::CODE_FIELD])) &&
                (isset($errorMeta[ErrorMetaDataDto::MESSAGE_FIELD])) &&
                !(isset($errorMeta[ErrorMetaDataDto::SUB_CODE_FIELD]))
            ){
                $type = $errorMeta[ErrorMetaDataDto::TYPE_FIELD];
                $code = $errorMeta[ErrorMetaDataDto::CODE_FIELD];
                $message = $errorMeta[ErrorMetaDataDto::MESSAGE_FIELD];
                return new ErrorMetaDataDto($type, $code, $message);
            }else {
                throw new ErrorDtoDeserializationError();
            }
        }
        catch(TypeError $e){
            throw new ErrorDtoDeserializationError();
        }
    }
}