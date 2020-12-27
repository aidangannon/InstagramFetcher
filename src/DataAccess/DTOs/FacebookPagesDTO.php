<?php


namespace InstaFetcher\DataAccess\DTOs;


class FacebookPagesDTO
{
    public const DATA_FIELD = "data";

    /**
     * @var FacebookPageDTO[]
     */
    public array $data;

    /**
     * populates DTO from associative array
     */
    public static function hydrate(array $data): FacebookPagesDTO{
        throw new \BadMethodCallException("not implemented");
    }

}