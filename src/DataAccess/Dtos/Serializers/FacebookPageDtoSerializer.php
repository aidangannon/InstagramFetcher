<?php
declare(strict_types=1);

namespace InstaFetcher\DataAccess\Dtos\Serializers;


use InstaFetcher\DataAccess\Dtos\FacebookPageDto;
use InstaFetcher\DataAccess\Dtos\Serializers\Exception\FacebookPagesDtoDeserializationError;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IFacebookPageDtoSerializer;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IInstaUserDtoSerializer;
use TypeError;

class FacebookPageDtoSerializer implements IFacebookPageDtoSerializer
{

    private IInstaUserDtoSerializer $userSerializer;

    public function __construct(IInstaUserDtoSerializer $userSerializer)
    {
        $this->userSerializer = $userSerializer;
    }

    public function deserialize(array $page): FacebookPageDto
    {
        try {
            if (
                isset($page[FacebookPageDto::ID_FIELD]) &&
                isset($page[FacebookPageDto::INSTA_USER_FIELD])
            ) {
                return new FacebookPageDto(
                    $page[FacebookPageDto::ID_FIELD],
                    $this->userSerializer->deserialize($page[FacebookPageDto::INSTA_USER_FIELD])
                );
            }
            else{
                throw new FacebookPagesDtoDeserializationError();
            }
        }
        catch(TypeError $e){
            throw new FacebookPagesDtoDeserializationError();
        }
    }
}