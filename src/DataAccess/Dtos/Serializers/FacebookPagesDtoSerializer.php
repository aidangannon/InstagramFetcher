<?php


namespace InstaFetcher\DataAccess\Dtos\Serializers;


use InstaFetcher\DataAccess\Dtos\FacebookPagesDto;
use InstaFetcher\DataAccess\Dtos\Serializers\Exception\FacebookPagesDtoDeserializationError;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IFacebookPageDtoSerializer;
use InstaFetcher\Interfaces\DataAccess\DtoSerializer\IFacebookPagesDtoSerializer;
use TypeError;

class FacebookPagesDtoSerializer implements IFacebookPagesDtoSerializer
{
    private IFacebookPageDtoSerializer $pageSerializer;

    public function __construct(IFacebookPageDtoSerializer $pageSerializer)
    {
        $this->pageSerializer = $pageSerializer;
    }

    public function deserialize(array $pages): FacebookPagesDto
    {
        try {
            if (
                isset($pages[FacebookPagesDto::DATA_FIELD])&&
                is_array($pages[FacebookPagesDto::DATA_FIELD])
            ) {
                $pageDtos = [];
                foreach ($pages[FacebookPagesDto::DATA_FIELD] as $page) {
                    array_push($pageDtos, $this->pageSerializer->deserialize($page));
                }
                return new FacebookPagesDto($pageDtos);
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