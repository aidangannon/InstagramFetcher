<?php


namespace InstaFetcher\Interfaces\DataAccess\DtoSerializer;

use InstaFetcher\DataAccess\Dtos\FacebookPagesDto;

/**
 * handles mapping of pages dtos
 */
interface IFacebookPagesDtoSerializer
{
    /**
     * maps the array onto a dto
     */
    public function deserialize(array $pages): FacebookPagesDto;
}