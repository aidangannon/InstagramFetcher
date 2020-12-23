<?php

namespace InstaFetcher\DataAccess\DTOs;

use \BadMethodCallException;

class InsightDTO
{
    public const VALUE_FIELD = "value";

    public ?array $value;

    /**
     * populates DTO from associative array
     */
    public static function hydrate(array $data): InsightDTO{
        $insight = new InsightDTO();

        isset($data[InsightDTO::VALUE_FIELD]) ? $insight->value = $data[InsightDTO::VALUE_FIELD] : $insight->value = null;

        return $insight;
    }
}