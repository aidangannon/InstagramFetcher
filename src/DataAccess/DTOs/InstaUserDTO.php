<?php

namespace InstaFetcher\DataAccess\DTOs;

use Pinq\Traversable;
use ReflectionObject;
use ReflectionProperty;

class InstaUserDTO
{
    public const ID_FIELD = "id";
    public const FOLLOWERS_FIELD = "followers_count";

    public ?string $id;

    public ?string $followersCount;

    /**
     * populates the DTO with associative array data
     */
    public static function hydrate(array $data): InstaUserDTO{
        $user = new InstaUserDTO;

        isset($data[InstaUserDTO::ID_FIELD]) ? $user->id = $data[InstaUserDTO::ID_FIELD] : $user->id = null;
        isset($data[InstaUserDTO::FOLLOWERS_FIELD]) ? $user->followersCount = $data[InstaUserDTO::FOLLOWERS_FIELD] : $user->followersCount = null;

        return $user;
    }
}