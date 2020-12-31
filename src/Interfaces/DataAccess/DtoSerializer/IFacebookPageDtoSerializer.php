<?php


namespace InstaFetcher\Interfaces\DataAccess\DtoSerializer;


use InstaFetcher\DataAccess\Dtos\FacebookPageDto;

/**
 * handles mapping of page dtos
 */
interface IFacebookPageDtoSerializer
{
    /**
     * maps the array onto a dto
     */
    public function deserialize(array $page): FacebookPageDto;
}