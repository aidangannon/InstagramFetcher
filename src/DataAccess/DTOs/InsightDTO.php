<?php

namespace InstaFetcher\DataAccess\DTOs;

use \BadMethodCallException;

class InsightDTO
{
    public array $value;

    public static function hydrate(array $data): InsightDTO{
        throw new BadMethodCallException("not implemented");
    }
}