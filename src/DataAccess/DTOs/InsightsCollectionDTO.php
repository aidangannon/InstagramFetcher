<?php
declare(strict_types=1);

namespace InstaFetcher\DataAccess\DTOs;

use BadMethodCallException;

class InsightsCollectionDTO
{
    /**
     * @var InsightsDTO[]
     */
    public array $data;

    public static function hydrate(array $data): InsightsCollectionDTO{
        throw new BadMethodCallException("not implemented");
    }
}