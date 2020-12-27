<?php


namespace InstaFetcher\DataAccess\DTOs\Mapper;


use InstaFetcher\DataAccess\DTOs\InstaUserDto;

class InstaUserDtoMapper
{

    /**
     * populates the DTO with associative array data
     */
    public function hydrate(array $data): InstaUserDto
    {
        $user = new InstaUserDto;

        $user->id = $data[InstaUserDto::ID_FIELD];
        $user->followersCount = $data[InstaUserDto::FOLLOWERS_FIELD];

        return $user;
    }
}