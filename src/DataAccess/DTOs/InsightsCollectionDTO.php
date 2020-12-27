<?php
declare(strict_types=1);

namespace InstaFetcher\DataAccess\DTOs;

use BadMethodCallException;

class InsightsCollectionDTO
{

    public const DATA_FIELD = "data";

    /**
     * @var InsightsDTO[]
     */
    public array $data = [];

    public static function hydrate(array $data): InsightsCollectionDTO{

        $insightsCollection = new InsightsCollectionDTO();

        foreach($data[InsightsCollectionDTO::DATA_FIELD] as $value){
            array_push($insightsCollection->data,InsightsDTO::hydrate($value));
        }

        return $insightsCollection;
    }
}