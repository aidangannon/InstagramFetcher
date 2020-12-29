<?php


namespace InstaFetcher\DataAccess\Dtos;


class FacebookPagesDto
{
    public const DATA_FIELD = "data";

    /**
     * @var FacebookPageDto[]
     */
    public array $data;

    /**
     * @param FacebookPageDto[] $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }


}