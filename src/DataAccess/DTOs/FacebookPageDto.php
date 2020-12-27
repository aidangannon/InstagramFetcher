<?php


namespace InstaFetcher\DataAccess\DTOs;


class FacebookPageDto
{
    public const ID_FIELD = "id";
    public const INSTA_USER_FIELD = "instagram_business_account";

    public string $id;
    public InstaUserDto $instaUser;

}