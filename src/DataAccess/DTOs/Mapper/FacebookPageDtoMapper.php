<?php


namespace InstaFetcher\DataAccess\DTOs\Mapper;


use InstaFetcher\DataAccess\DTOs\FacebookPageDto;
use InstaFetcher\DataAccess\DTOs\InstaUserDto;

class FacebookPageDtoMapper
{

    private InstaUserDtoMapper $instaUserDtoMapper;

    public function __construct(InstaUserDtoMapper $instaUserDtoMapper){
        $this->instaUserDtoMapper=$instaUserDtoMapper;
    }

    /**
     * populates DTO from associative array
     */
    public function hydrate(array $data): FacebookPageDto
    {
        throw new \BadMethodCallException("not implemented");
    }
}