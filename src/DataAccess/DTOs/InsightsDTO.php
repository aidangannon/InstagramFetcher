<?php
declare(strict_types=1);

namespace InstaFetcher\DataAccess\DTOs;

use BadMethodCallException;

class InsightsDTO
{
    public const VALUES_FIELD = "values";
    public const NAME_FIELD = "name";

    public ?string $name;

    /**
     * @var InsightDTO[]
     */
    public array $values=[];

    public static function hydrate(array $data): InsightsDTO{

        $insights = new InsightsDTO();

        if(isset($data[InsightsDTO::VALUES_FIELD])){
            foreach($data[InsightsDTO::VALUES_FIELD] as $value){
                array_push($insights->values,InsightDTO::hydrate($value));
            }
        }

        isset($data[InsightsDTO::NAME_FIELD]) ? $insights->name = $data[InsightsDTO::NAME_FIELD] : $insights->name = null;

        return $insights;
    }
}