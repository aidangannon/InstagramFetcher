<?php

namespace InstaFetcher\DataAccess\Dtos;

use Pinq\Traversable;
use ReflectionObject;
use ReflectionProperty;

class InstaUserDto
{
    public const ID_FIELD = "id";
    public const FOLLOWERS_FIELD = "followers_count";

    public string $id;

    public int $followersCount;

    public string $username;

    public function __construct(string $id, int $followersCount, string $username)
    {
        $this->id = $id;
        $this->followersCount = $followersCount;
        $this->username = $username;
    }


}