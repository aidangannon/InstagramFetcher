<?php

namespace InstaFetcher\DataAccess\Dtos;

class InstaUserDto
{
    public const ID_FIELD = "id";
    public const FOLLOWERS_FIELD = "followers_count";
    public const USERNAME_FIELD = "username";

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