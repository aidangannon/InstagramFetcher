<?php


namespace InstaFetcher\DataAccess\DTOs\Mapper;


use InstaFetcher\DataAccess\DTOs\FacebookPagesDto;

class FacebookPagesDtoMapper
{

    private FacebookPageDtoMapper $pageMapper;

    public function __construct(FacebookPageDtoMapper $pageMapper){
        $this->pageMapper=$pageMapper;
    }

    /**
     * populates DTO from associative array
     */
    public function hydrate(array $data): FacebookPagesDto
    {
        throw new \BadMethodCallException("not implemented");
    }
}