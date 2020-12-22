<?php

namespace InstaFetcher\DataAccess\DTOs;

use BadMethodCallException;

class InsightsDTO
{
    public string $name;

    /**
     * @var InsightDTO[]
     */
    public array $values;

    public static function hydrate(array $data): InsightsDTO{
        throw new BadMethodCallException("not implemented");
    }
}