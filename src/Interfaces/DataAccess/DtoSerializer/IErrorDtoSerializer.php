<?php


namespace InstaFetcher\Interfaces\DataAccess\DtoSerializer;


use InstaFetcher\DataAccess\Dtos\ErrorDto;

/**
 * handles mapping of error dtos
 */
interface IErrorDtoSerializer
{
    /**
     * maps the array onto a dto
     */
    public function deserialize(array $error): ErrorDto;
}