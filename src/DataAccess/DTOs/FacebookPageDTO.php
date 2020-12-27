<?php


namespace InstaFetcher\DataAccess\DTOs;


class FacebookPageDTO
{
    public const ID_FIELD = "id";
    public const INSTA_USER_FIELD = "instagram_business_account";

    public string $id;
    public string $instaUser;

    /**
     * populates DTO from associative array
     */
    public static function hydrate(array $data): FacebookPageDTO{
        throw new \BadMethodCallException("not implemented");
    }

}