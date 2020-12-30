<?php


namespace InstaFetcher\Interfaces\DataAccess\DtoSerializer;


use InstaFetcher\DataAccess\Dtos\InstaUserDto;

/**
 * handles mapping of user dtos
 */
interface IInstaUserDtoSerializer
{
    /**
     * maps the array onto a dto
     */
    public function deserialize(array $user): InstaUserDto;
}