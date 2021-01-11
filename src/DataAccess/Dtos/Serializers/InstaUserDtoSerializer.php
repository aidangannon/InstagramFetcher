<?php


namespace InstaFetcher\DataAccess\Dtos\Serializers;


use InstaFetcher\DataAccess\Dtos\InstaUserDto;
use InstaFetcher\DataAccess\Dtos\Serializers\Exception\InstaUserDtoDeserializationError;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IInstaUserDtoSerializer;
use TypeError;

class InstaUserDtoSerializer implements IInstaUserDtoSerializer
{

    public function deserialize(array $user): InstaUserDto
    {
        try {
            if (
                (isset($user[InstaUserDto::ID_FIELD])) &&
                (isset($user[InstaUserDto::FOLLOWERS_FIELD])) &&
                (isset($user[InstaUserDto::USERNAME_FIELD]))
            ) {
                $id = $user[InstaUserDto::ID_FIELD];
                $followers = $user[InstaUserDto::FOLLOWERS_FIELD];
                $username = $user[InstaUserDto::USERNAME_FIELD];
                return new InstaUserDto($id, $followers, $username);
            } else {
                throw new InstaUserDtoDeserializationError();
            }
        }
        catch(TypeError $e){
            throw new InstaUserDtoDeserializationError();
        }
    }
}