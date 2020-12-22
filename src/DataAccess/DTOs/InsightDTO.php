<?php

namespace InstaFetcher\DataAccess\DTOs;

use \BadMethodCallException;

class InsightDTO
{
    public ?array $value;

    /**
     * populates DTO from associative array
     */
    public static function hydrate(array $data): InsightDTO{
        $insight = new InsightDTO();

        isset($data["value"]) ? $insight->value = $data["value"] : $insight->value = null;

        return $insight;
    }
}