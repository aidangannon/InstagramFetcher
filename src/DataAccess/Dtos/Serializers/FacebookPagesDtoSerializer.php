<?php


namespace InstaFetcher\DataAccess\Dtos\Serializers;


use BadMethodCallException;
use InstaFetcher\DataAccess\Dtos\FacebookPagesDto;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IFacebookPageDtoSerializer;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IFacebookPagesDtoSerializer;

class FacebookPagesDtoSerializer implements IFacebookPagesDtoSerializer
{
    private IFacebookPageDtoSerializer $pageSerializer;

    public function __construct(IFacebookPageDtoSerializer $pageSerializer)
    {
        $this->pageSerializer = $pageSerializer;
    }

    public function deserialize(array $pages): FacebookPagesDto
    {
        throw new BadMethodCallException("not implemented");
    }
}