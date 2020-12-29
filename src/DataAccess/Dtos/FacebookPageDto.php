<?php


namespace InstaFetcher\DataAccess\Dtos;


class FacebookPageDto
{
    public const ID_FIELD = "id";
    public const INSTA_USER_FIELD = "instagram_business_account";

    public string $id;
    public InstaUserDto $instaUser;

    public function __construct(string $id, InstaUserDto $instaUser)
    {
        $this->id = $id;
        $this->instaUser = $instaUser;
    }


}