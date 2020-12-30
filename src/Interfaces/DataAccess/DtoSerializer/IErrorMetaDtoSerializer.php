<?php


namespace InstaFetcher\Interfaces\DataAccess\DtoSerializer;

use InstaFetcher\DataAccess\Dtos\ErrorDto;
use InstaFetcher\DataAccess\Dtos\ErrorMetaDataDto;

/**
 * handles mapping of error meta dtos
 */
interface IErrorMetaDtoSerializer
{
    /**
     * maps the array onto a dto
     */
    public function deserialize(array $errorMeta): ErrorMetaDataDto;
}