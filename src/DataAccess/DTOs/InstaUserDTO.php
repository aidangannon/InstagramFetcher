<?php

namespace InstaFetcher\DataAccess\DTOs;

use Pinq\Traversable;
use ReflectionObject;
use ReflectionProperty;

class InstaUserDTO
{
    public ?string $id;

    public ?string $followersCount;

    /**
     * populates the DTO with associative array data
     */
    public static function hydrate(array $data): InstaUserDTO{
        $user = new InstaUserDTO;

        isset($data["id"]) ? $user->id = $data["id"] : $user->id = null;
        isset($data["followers_count"]) ? $user->followersCount = $data["followers_count"] : $user->followersCount = null;

        return $user;
    }
}