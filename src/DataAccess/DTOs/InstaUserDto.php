<?php

namespace InstaFetcher\DataAccess\DTOs;

use Pinq\Traversable;
use ReflectionObject;
use ReflectionProperty;

class InstaUserDto
{
    public const ID_FIELD = "id";
    public const FOLLOWERS_FIELD = "followers_count";

    public string $id;

    public string $followersCount;

}