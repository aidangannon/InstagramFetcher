<?php


namespace InstaFetcher\DataAccess\Dtos\Serializers;


use BadMethodCallException;
use InstaFetcher\DataAccess\Dtos\FacebookPageDto;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IFacebookPageDtoSerializer;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IInstaUserDtoSerializer;

class FacebookPageDtoSerializer implements IFacebookPageDtoSerializer
{

    private IInstaUserDtoSerializer $userSerializer;

    public function __construct(IInstaUserDtoSerializer $userSerializer)
    {
        $this->userSerializer = $userSerializer;
    }

    public function deserialize(array $page): FacebookPageDto
    {
        throw new BadMethodCallException("not implemented");
    }
}