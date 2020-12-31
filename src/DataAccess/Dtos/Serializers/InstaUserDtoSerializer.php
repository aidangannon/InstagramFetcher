<?php


namespace InstaFetcher\DataAccess\Dtos\Serializers;


use BadMethodCallException;
use InstaFetcher\DataAccess\Dtos\InstaUserDto;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IInstaUserDtoSerializer;

class InstaUserDtoSerializer implements IInstaUserDtoSerializer
{

    public function deserialize(array $user): InstaUserDto
    {
        throw new BadMethodCallException("not implemented");
    }
}